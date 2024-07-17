<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Surat_perintah_kerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class SuratPerintahKerjaViewWebController extends Controller
{
    function numberToRomanRepresentation($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }


    public function index(Request $request)
    {
        $userData = Session::get('user');
        $username = $userData ['first_name'];
        $designation = $userData ['designation'];
        $userrole = $userData['modules']['name'];
        $userId = $userData['id'];
        $suratPerintahKerjas = Surat_perintah_kerja::with(['approvals', 'details'])->orderBy('created_at', 'desc')->get();
        return view('suratPerintahKerja.index', compact('suratPerintahKerjas'));
    }

    private function generateDocumentNumber()
    {
        $lastId = Surat_perintah_kerja::orderBy('id', 'desc')->first()->id ?? 0;
        $nextId = $lastId + 1;
        $currentYear = date('Y');
        $currentMonth = date('m');
        $no_spk = $nextId . '-SPK/SII/' . $this->numberToRomanRepresentation($currentMonth) . '/' . $currentYear;
        return $no_spk;
    }


    public function create()
    {
        $token = Session::get('token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_MASTER_PROJECT') . 'get-project/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $projects = json_decode($response, true)['data'];
        $userData = Session::get('user');
        $username = $userData['first_name'];
        $designation = $userData['designation'];
        $no_spk = $this->generateDocumentNumber();
        return view('suratPerintahKerja.create')
            ->with('projects', $projects)
            ->with('no_spk', $no_spk)
            ->with('username', $username)
            ->with('designation', $designation);
    }


    public function store(Request $request)
    {
        // $data_each_row = explode("\r\n",$request->job_description);
        // foreach($data_each_row as $data ){
        //     $count_string_data = strlen($data);
        //     if($count_string_data >84){
        //         $data = $count_string_data;
        //     }

        // }
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'applicant_name' => 'required|string',
            'receiver_name' => 'nullable|string',
            'approver_name' => 'required|string',
            'board_of_directors' => 'required|string',
            'applicant_position' => 'required|string',
            'receiver_position' => 'nullable|string',
            'approver_position' => 'required|string',
            'position' => 'required|string',
            'title' => 'required|string',
            'user' => 'required|string',
            'main_contractor' => 'required|string',
            'project_manager' => 'required|string',
            'submission_date' => 'required|string',
            'priority' => 'required|string',
            'completion_time' => 'nullable|string',
            'pic' => 'nullable|string',
            'type_format_pekerjaan' => 'required|string',
            'job_type' => 'nullable|string',
            'job_description' => 'nullable|string',
            'supporting_document_type' => 'nullable|string',
            'supporting_document_file' => 'nullable|array|max:3',
            'supporting_document_file.*' => 'nullable|file|max:5000',
            'spesifikasi.*' => 'nullable|string',
            'jumlah.*' => 'nullable|integer',
            'satuan.*' => 'nullable|string',
            'keterangan.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $submission_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->submission_date)));

        $userData = Session::get('user');
        $userId = $userData['id'];

        $suratPerintahKerjas = Surat_perintah_kerja::create([
            'form_number' => 'spk',
            'user_id' => $userId,
            'code' => $request->code,
            'title' => $request->title,
            'user' => $request->user,
            'main_contractor' => $request->main_contractor,
            'project_manager' => $request->project_manager,
            'no_spk' => 'spk',
            'submission_date' => $submission_date,
            'priority' => $request->priority,
            'completion_time' => $request->completion_time,
            'pic' => $request->pic,
            'job_type' => $request->job_type,
            'job_description' => $request->job_description,
            'type_format_pekerjaan' => $request->type_format_pekerjaan,
        ]);

        if ($request->has('spesifikasi') && $request->has('jumlah') && $request->has('satuan') && $request->has('keterangan')) {
            $details = [];

            foreach ($request->spesifikasi as $index => $spesifikasi) {
                $details[] = [
                    'spesifikasi' => $spesifikasi,
                    'jumlah' => $request->jumlah[$index],
                    'satuan' => $request->satuan[$index],
                    'keterangan' => $request->keterangan[$index],
                ];
            }

            $suratPerintahKerjas->details_permintaan()->createMany($details);
        }

        if ($request->hasFile('supporting_document_file')) {
            $filePaths = [];

            foreach ($request->file('supporting_document_file') as $file) {
                $fileName = uniqid() . '_' . $suratPerintahKerjas->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('partas/posts/images');
                $file->move($destinationPath, $fileName);
                $filePath = 'partas/posts/images/' . $fileName;
                $filePaths[] = $filePath;
            }

            $suratPerintahKerjas->details()->create([
                'supporting_document_type' => $request->supporting_document_type,
                'supporting_document_file' => json_encode($filePaths),
            ]);
        } else {
            $existingDetail = $suratPerintahKerjas->details()->first();
            $suratPerintahKerjas->details()->create([
                'supporting_document_type' => $request->supporting_document_type,
                'supporting_document_file' => $existingDetail ? $existingDetail->supporting_document_file : null,
            ]);
        }

        $suratPerintahKerjas->approvals()->create([
            'applicant_name' => $request->applicant_name,
            'receiver_name' => $request->receiver_name,
            'approver_name' => $request->approver_name,
            'board_of_directors' => $request->board_of_directors,
            'applicant_position' => $request->applicant_position,
            'receiver_position' => $request->receiver_position,
            'approver_position' => $request->approver_position,
            'position' => $request->position,
        ]);

        $datas = Surat_perintah_kerja::where('id', $suratPerintahKerjas->id)->first();
        $datetime = explode('-', $datas->created_at);
        $no_spk = $suratPerintahKerjas->id . '-SPK/SII/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas = Surat_perintah_kerja::where('id', $suratPerintahKerjas->id)->update([
            'no_spk' => $no_spk,
            'form_number' => $no_spk
        ]);

        return redirect(route('surat_perintah_kerja.index'))->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function ShowPDF($id)
    {
        $suratPerintahKerjas = Surat_perintah_kerja::with('approvals', 'details', 'details_permintaan')->where('id', (int)$id)->get();
        $typeFormatPekerjaan = $suratPerintahKerjas->first()->type_format_pekerjaan;
        if ($typeFormatPekerjaan == 'Surat Perintah Kerja') {
            $pdf = PDF::loadView('suratPerintahKerja.surat_perintah_kerja', compact('suratPerintahKerjas'));
        } elseif ($typeFormatPekerjaan == 'Surat Permintaan Barang') {
            $pdf = PDF::loadView('suratPerintahKerja.surat_permintaan_barang', compact('suratPerintahKerjas'));
        } else {
            abort(404, 'Type format pekerjaan tidak dikenali');
        }
        $pdf->setPaper(array(0, 0, 785, 1000));
        return $pdf->stream();
    }


    public function edit($id)
    {
        $token = Session::get('token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_MASTER_PROJECT') . 'get-project/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $projects = json_decode($response, true)['data'];

        $suratPerintahKerja = Surat_perintah_kerja::with(['details_permintaan', 'details', 'approvals'])->find($id);

        if (!$suratPerintahKerja) {
            return redirect(route('surat_perintah_kerja.index'))->with(['error' => 'Data Tidak Ditemukan!']);
        }

        return view('suratPerintahKerja.edit')
            ->with('projects', $projects)
            ->with('suratPerintahKerja', $suratPerintahKerja)
            ->with('details', $suratPerintahKerja->details_permintaan)
            ->with('details_job', $suratPerintahKerja->details);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code'                     => 'required|string',
            'applicant_name'           => 'required|string',
            'receiver_name'            => 'nullable|string',
            'approver_name'            => 'required|string',
            'board_of_directors'       => 'required|string',
            'applicant_position'       => 'required|string',
            'receiver_position'        => 'nullable|string',
            'approver_position'        => 'required|string',
            'position'                 => 'required|string',
            'title'                    => 'required|string',
            'user'                     => 'required|string',
            'main_contractor'          => 'required|string',
            'project_manager'          => 'required|string',
            'submission_date'          => 'required|string',
            'priority'                 => 'required|string',
            'completion_time'          => 'nullable|string',
            'pic'                      => 'nullable|string',
            'type_format_pekerjaan'    => 'required|string',
            'job_type'                 => 'nullable|string',
            'job_description'          => 'nullable|string',
            'supporting_document_type' => 'nullable|string',
            'supporting_document_file' => 'nullable|array|max:3',
            'supporting_document_file.*' => 'nullable|file|max:5000',
            'spesifikasi.*'            => 'nullable|string',
            'jumlah.*'                 => 'nullable|integer',
            'satuan.*'                 => 'nullable|string',
            'keterangan.*'             => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $submission_date = date("Y-m-d", strtotime(str_replace('/', '-', $request->submission_date)));

        $suratPerintahKerja = Surat_perintah_kerja::find($id);

        if (!$suratPerintahKerja) {
            return redirect(route('surat_perintah_kerja.index'))->with(['error' => 'Data Tidak Ditemukan!']);
        }

        $suratPerintahKerja->update([
            'code'                     => $request->code,
            'title'                    => $request->title,
            'user'                     => $request->user,
            'main_contractor'          => $request->main_contractor,
            'project_manager'          => $request->project_manager,
            'submission_date'          => $submission_date,
            'priority'                 => $request->priority,
            'completion_time'          => $request->completion_time,
            'pic'                      => $request->pic,
            'job_type'                 => $request->job_type,
            'job_description'          => $request->job_description,
            'type_format_pekerjaan'    => $request->type_format_pekerjaan,
        ]);

        if ($request->type_format_pekerjaan === 'Surat Perintah Kerja') {
            if ($request->hasFile('supporting_document_file')) {
                $oldFiles = json_decode($suratPerintahKerja->details->first()->supporting_document_file);
                if ($oldFiles) {
                    foreach ($oldFiles as $oldFile) {
                        if (file_exists(public_path($oldFile))) {
                            unlink(public_path($oldFile));
                        }
                    }
                }

                $filePaths = [];

                foreach ($request->file('supporting_document_file') as $file) {
                    $fileName = uniqid() . '_' . $suratPerintahKerja->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('partas/posts/images');
                    $file->move($destinationPath, $fileName);
                    $filePaths[] = 'partas/posts/images/' . $fileName;
                }

                $suratPerintahKerja->details()->update([
                    'supporting_document_type' => $request->supporting_document_type,
                    'supporting_document_file' => json_encode($filePaths),
                ]);
            } else {
                if ($request->supporting_document_type === null) {
                    $suratPerintahKerja->details()->update([
                        'supporting_document_type' => null,
                        'supporting_document_file' => null,
                    ]);
                } else {
                    $suratPerintahKerja->details()->update([
                        'supporting_document_type' => $request->supporting_document_type,
                        'supporting_document_file' => $suratPerintahKerja->details()->first()->supporting_document_file,
                    ]);
                }
            }

            $suratPerintahKerja->details_permintaan()->update([
                'spesifikasi' => null,
                'jumlah'      => null,
                'satuan'      => null,
                'keterangan'  => null,
            ]);
        } elseif ($request->type_format_pekerjaan === 'Surat Permintaan Barang') {
            if ($request->has('spesifikasi') && $request->has('jumlah') && $request->has('satuan') && $request->has('keterangan')) {
                $suratPerintahKerja->details_permintaan()->delete();

                $details = [];

                foreach ($request->spesifikasi as $index => $spesifikasi) {
                    $details[] = [
                        'spesifikasi' => $spesifikasi,
                        'jumlah'      => $request->jumlah[$index],
                        'satuan'      => $request->satuan[$index],
                        'keterangan'  => $request->keterangan[$index],
                    ];
                }

                $suratPerintahKerja->details_permintaan()->createMany($details);
            }

            $suratPerintahKerja->details()->update([
                'supporting_document_type' => null,
                'supporting_document_file' => null,
            ]);
        }

        $suratPerintahKerja->approvals()->update([
            'applicant_name'     => $request->applicant_name,
            'receiver_name'      => $request->receiver_name,
            'approver_name'      => $request->approver_name,
            'board_of_directors' => $request->board_of_directors,
            'applicant_position' => $request->applicant_position,
            'receiver_position'  => $request->receiver_position,
            'approver_position'  => $request->approver_position,
            'position'           => $request->position,
        ]);

        return redirect(route('surat_perintah_kerja.index'))->with(['success' => 'Data Berhasil Diperbarui!']);
    }


    public function destroy($id)
    {
        $suratPerintahKerjas = Surat_perintah_kerja::find($id);
        if (!$suratPerintahKerjas) {
            return redirect()->back()->with('error', 'Data Surat Perintah Kerja tidak ditemukan!');
        }
        if ($suratPerintahKerjas->dokumen_pendukung_file) {
            Storage::delete('public/posts/images/' . basename($suratPerintahKerjas->dokumen_pendukung_file));
        }
        $suratPerintahKerjas->delete();
        return redirect('/surat-perintah-kerja')->with('success', 'Data Surat Perintah Kerja berhasil dihapus.');
    }


    public function exportPDF($id)
    {
        $suratPerintahKerjas = Surat_perintah_kerja::with('approvals', 'details')->where('id', (int)$id)->get();
        $pdf = PDF::loadView('suratPerintahKerja.show', compact('suratPerintahKerjas'));
        return $pdf->download('surat_perintah_kerja.pdf');
    }
}
