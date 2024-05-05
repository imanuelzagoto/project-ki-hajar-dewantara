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
        $suratPerintahKerjas = Surat_perintah_kerja::orderBy('created_at', 'desc')->get();

        return view('suratPerintahKerja.index', compact('suratPerintahKerjas'));
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
        // dd($response);
        curl_close($curl);
        $projects = json_decode($response, true)['data'];
        return view('suratPerintahKerja.create')
            ->with('projects', $projects);
    }


    public function store(Request $request)
    {
        // dd($request);
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'code'          => 'required|string',
            'pemohon'               => 'required',
            'penerima'               => 'nullable|string',
            'menyetujui'               => 'nullable|string',
            'jabatan_1'               => 'required',
            'jabatan_2'               => 'nullable|string',
            'jabatan_3'               => 'nullable|string',
            'title'          => 'required|string',
            'user'                  => 'required',
            'main_contractor'       => 'required',
            'project_manager'       => 'required',
            'tanggal' => 'required',
            'prioritas' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable',
            'pic' => 'required',
            'jenis_pekerjaan'               => 'required',
            'uraian_pekerjaan'               => 'required',
            'dokumen_pendukung_type' => 'nullable|string',
            // 'dokumen_pendukung_file' => 'nullable|file|mimes:jpeg,png,jpg,poster,pdf,csv,txt|max:2048',
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle file upload if exists
        $dokumen_pendukung_file = null;
        if ($request->hasFile('dokumen_pendukung_file')) {
            $destinationPath = '/posts/images';
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file')->hashName();
            $request->file('dokumen_pendukung_file')->move(public_path($destinationPath), $dokumen_pendukung_file);
        }

        // Create the record
        $suratPerintahKerjas = Surat_perintah_kerja::create([
            'form_number' => 'spk',
            'code' => $request->code,
            'pemohon' => $request->pemohon,
            'penerima' => $request->penerima,
            'menyetujui' => $request->menyetujui,
            'jabatan_1' => $request->jabatan_1,
            'jabatan_2' => $request->jabatan_2,
            'jabatan_3' => $request->jabatan_3,
            'title' => $request->title,
            'user' => $request->user,
            'main_contractor' => $request->main_contractor,
            'project_manager' => $request->project_manager,
            'no_spk' => 'spk',
            'tanggal' => $request->tanggal,
            'prioritas' => $request->prioritas,
            'waktu_penyelesaian' => $request->waktu_penyelesaian,
            'pic' => $request->pic,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'uraian_pekerjaan' => $request->uraian_pekerjaan,
            'dokumen_pendukung_type' => $request->dokumen_pendukung_type,
            'dokumen_pendukung_file' => $request->dokumen_pendukung_file,
            'file_pendukung_lainnya' => $request->file_pendukung_lainnya
        ]);
        // 022/FPD/ADM/I/2024
        $datas = Surat_perintah_kerja::where('id', $suratPerintahKerjas->id)->first();
        $datetime = explode('-', $datas->created_at);
        $no_spk = $suratPerintahKerjas->id . '-SPK/SII/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas = Surat_perintah_kerja::where('id', $suratPerintahKerjas->id)->update([
            'no_spk' => $no_spk,
            'form_number' => $no_spk
        ]);


        // dd($suratPerintahKerjas->code);
        // Return response
        return redirect(route('surat_perintah_kerja.index'));
    }


    public function show($id)
    {
        $suratPerintahKerjas = Surat_perintah_kerja::where('id', (int)$id)->get();
        $pdf = PDF::loadView('suratPerintahKerja.show', compact('suratPerintahKerjas'));
        $pdf->setPaper(array(0, 0, 1010.45, 841.7), 'landscape');
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
        // dd($projects);
        $suratPerintahKerjas = Surat_perintah_kerja::find($id);
        return view('suratPerintahKerja.edit')
            ->with('suratPerintahKerjas', $suratPerintahKerjas)
            ->with('projects', $projects);
    }


    public function update(Request $request, $id)
    {
        // dd($request->code);
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'code'          => 'required',
            'pemohon'               => 'required',
            'penerima'               => 'nullable|string',
            'menyetujui'               => 'nullable|string',
            'jabatan_1'               => 'required',
            'jabatan_2'               => 'nullable|string',
            'jabatan_3'               => 'nullable|string',
            'title'          => 'required',
            'user'                  => 'required',
            'main_contractor'       => 'required',
            'project_manager'       => 'required',
            'tanggal' => 'required',
            'prioritas' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable',
            'pic' => 'required',
            'jenis_pekerjaan'               => 'required',
            'uraian_pekerjaan'               => 'required',
            'dokumen_pendukung_type' => 'nullable|string',
            // 'dokumen_pendukung_file' => 'nullable|file|mimes:jpeg,png,jpg,poster,pdf,csv,txt|max:2048',
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // dd($id);
        // Find the Surat_perintah_kerja by ID
        $suratPerintahKerjas = Surat_perintah_kerja::find($id);

        // Check if dokumen_pendukung_file is not empty
        if ($request->hasFile('dokumen_pendukung_file')) {
            // Upload file
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file');
            $dokumen_pendukung_file->storeAs('public/posts/images', $dokumen_pendukung_file->hashName());
            if ($suratPerintahKerjas->dokumen_pendukung_file) {
                Storage::delete('public/posts/images/' . basename($suratPerintahKerjas->dokumen_pendukung_file));
            }
        } else {
            $dokumen_pendukung_file = $suratPerintahKerjas->dokumen_pendukung_file;
        }
        // Update Surat_perintah_kerja with new or old values
        if ($request->dokumen_pendukung_file) {
            $suratPerintahKerjas->update([
                'code'          => $request->code,
                'pemohon'               => $request->pemohon,
                'penerima'               => $request->penerima,
                'menyetujui'               => $request->menyetujui,
                'jabatan_1'               => $request->jabatan_1,
                'jabatan_2'               => $request->jabatan_2,
                'jabatan_3'               => $request->jabatan_3,
                'title'          => $request->title,
                'user'                  => $request->user,
                'main_contractor'       => $request->main_contractor,
                'project_manager'       => $request->project_manager,
                'tanggal'               => $request->tanggal,
                'prioritas'             => $request->prioritas,
                'waktu_penyelesaian'    => $request->waktu_penyelesaian,
                'pic'                   => $request->pic,
                'jenis_pekerjaan'       => $request->jenis_pekerjaan,
                'uraian_pekerjaan'      => $request->uraian_pekerjaan,
                'dokumen_pendukung_type' => $request->dokumen_pendukung_type,
                'dokumen_pendukung_file' => $request->dokumen_pendukung_file,
                'file_pendukung_lainnya' => $request->file_pendukung_lainnya,
            ]);
        } else {
            $suratPerintahKerjas->update([
                'code'          => $request->code,
                'pemohon'               => $request->pemohon,
                'penerima'               => $request->penerima,
                'menyetujui'               => $request->menyetujui,
                'jabatan_1'               => $request->jabatan_1,
                'jabatan_2'               => $request->jabatan_2,
                'jabatan_3'               => $request->jabatan_3,
                'title'          => $request->title,
                'user'                  => $request->user,
                'main_contractor'       => $request->main_contractor,
                'project_manager'       => $request->project_manager,
                'tanggal'               => $request->tanggal,
                'prioritas'             => $request->prioritas,
                'waktu_penyelesaian'    => $request->waktu_penyelesaian,
                'pic'                   => $request->pic,
                'jenis_pekerjaan'       => $request->jenis_pekerjaan,
                'uraian_pekerjaan'      => $request->uraian_pekerjaan,
            ]);
        }

        // Return response
        return redirect(route('surat_perintah_kerja.index'));
    }


    public function destroy($id)
    {
        // Temukan Surat_perintah_kerja berdasarkan ID
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
        $suratPerintahKerjas = Surat_perintah_kerja::where('id', (int)$id)->get();
        $pdf = PDF::loadView('suratPerintahKerja.show', compact('suratPerintahKerjas'));
        return $pdf->download('surat_perintah_kerja.pdf');
    }
}
