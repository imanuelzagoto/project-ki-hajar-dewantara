<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Surat_perintah_kerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class SuratPerintahKerjaViewWebController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index(Request $request)
    {
        return view('suratPerintahKerja.index');
    }

    public function data()
    {
        $datas = Surat_perintah_kerja::select('*');

        return Datatables::of($datas)
            ->addIndexColumn()
            ->addColumn('action', function ($surat_perintah_kerjas) {
                return '
            <div style="display: flex;">
                <a href="' . route('suratPerintahKerja.edit', $surat_perintah_kerjas->id) . '"
                    class="fas fa-pen btn btn-sm tooltip-container"
                    style="color:#4FD1C5; font-size:20px;">
                    <span class="tooltip-edit">Edit</span>
                </a>
                <a href="' . route('suratPerintahKerja.show', $surat_perintah_kerjas->id) . '"
                    class="fas fa-eye btn btn-sm tooltip-container"
                    style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                    <span class="tooltip-show">View</span>
                </a>
                <a href="#" 
                        class="fas fa-trash-alt btn btn-sm tooltip-container" 
                        style="color:#F31414; font-size:20px;" 
                        onclick="submitDelete(' . $surat_perintah_kerjas->id . ')">
                        <span class="tooltip-delete">Delete</span>
                    </a>
                    <form id="delete-form-' . $surat_perintah_kerjas->id . '" 
                        action="' . route('surat_perintah_kerja.destroy', $surat_perintah_kerjas->id) . '" 
                        method="POST" style="display: none;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                    </form>
            </div>
        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create()
    {
        return view('suratPerintahKerja.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'kode_project' => 'required',
            'pemohon' => 'required',
            'nama_project' => 'required',
            'user' => 'required',
            'main_contractor' => 'required',
            'project_manager' => 'required',
            'no_spk' => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            'prioritas' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable|date_format:d/m/Y',
            'pic' => 'required',
            'dokumen_pendukung_type' => 'nullable|string',
            'dokumen_pendukung_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,poster,csv,txt|max:2048',
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Manipulate 'tanggal' date before creating the record
        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

        // Manipulate 'waktu_penyelesaian' date before creating the record
        $waktu_penyelesaian = $request->waktu_penyelesaian ? Carbon::createFromFormat('d/m/Y', $request->waktu_penyelesaian)->format('Y-m-d') : null;

        // Handle file upload if exists
        $dokumen_pendukung_file = null;
        if ($request->hasFile('dokumen_pendukung_file')) {
            $destinationPath = '/posts/images'; // change this destination path according to your needs
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file')->hashName();
            $request->file('dokumen_pendukung_file')->move(public_path($destinationPath), $dokumen_pendukung_file);
        }

        // Create the record
        $surat_Perintah_Kerja = Surat_perintah_kerja::create([
            'kode_project' => $request->kode_project,
            'pemohon' => $request->pemohon,
            'nama_project' => $request->nama_project,
            'user' => $request->user,
            'main_contractor' => $request->main_contractor,
            'project_manager' => $request->project_manager,
            'no_spk' => $request->no_spk,
            'tanggal' => $tanggal,
            'prioritas' => $request->prioritas,
            'waktu_penyelesaian' => $waktu_penyelesaian,
            'pic' => $request->pic,
            'dokumen_pendukung_type' => $request->dokumen_pendukung_type,
            'dokumen_pendukung_file' => $dokumen_pendukung_file,
            'file_pendukung_lainnya' => $request->file_pendukung_lainnya,
        ]);

        // Return response
        return redirect()->route('suratPerintahKerja.index');
    }

    /**
     * show
     *
     * @param  mixed $surat_perintah_kerja
     * @return void
     */
    public function show($id)
    {
        // Find surat perintah kerja by ID
        $suratPerintahKerja = Surat_perintah_kerja::find($id);

        // Check if the Surat_perintah_kerja exists
        if ($suratPerintahKerja) {
            return view('suratPerintahKerja.show', compact('suratPerintahKerja'));
        } else {
            return view('page404');
        }
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        // find data spk berdasarkan id
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);
        // check if the spk exists
        if ($surat_Perintah_Kerja) {
            return view('suratPerintahKerja.edit')->with('surat_Perintah_Kerja', $surat_Perintah_Kerja);
        } else {
            return view('page404');
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $surat_Perintah_Kerja
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'kode_project'          => 'required',
            'pemohon'               => 'required',
            'nama_project'          => 'required',
            'user'                  => 'required',
            'main_contractor'       => 'required',
            'project_manager'       => 'required',
            'no_spk'                => 'required',
            'tanggal' => 'required|date_format:d/m/Y',
            'prioritas' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable|date_format:d/m/Y',
            'pic' => 'required',
            'dokumen_pendukung_type' => 'nullable|string',
            'dokumen_pendukung_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,poster,csv,txt|max:2048',
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Manipulasi tanggal 'tanggal' sebelum memperbarui data surat perintah kerja
        $request['tanggal'] = Carbon::createFromFormat('d/m/Y', $request['tanggal'])->format('Y-m-d');

        // Manipulasi tanggal 'waktu_penyelesaian' sebelum memperbarui data surat perintah kerja
        $request['waktu_penyelesaian'] = $request['waktu_penyelesaian'] ? Carbon::createFromFormat('d/m/Y', $request['waktu_penyelesaian'])->format('Y-m-d') : null;


        // Find the Surat_perintah_kerja by ID
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);

        // Check if dokumen_pendukung_file is not empty
        if ($request->hasFile('dokumen_pendukung_file')) {
            // Upload file
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file');
            $dokumen_pendukung_file->storeAs('public/posts/images', $dokumen_pendukung_file->hashName());

            // Delete old file if exists
            if ($surat_Perintah_Kerja->dokumen_pendukung_file) {
                Storage::delete('public/posts/images/' . basename($surat_Perintah_Kerja->dokumen_pendukung_file));
            }
        } else {
            $dokumen_pendukung_file = $surat_Perintah_Kerja->dokumen_pendukung_file;
        }

        // Update Surat_perintah_kerja with new or old values
        $surat_Perintah_Kerja->update([
            'kode_project'          => $request->kode_project,
            'pemohon'               => $request->pemohon,
            'nama_project'          => $request->nama_project,
            'user'                  => $request->user,
            'main_contractor'       => $request->main_contractor,
            'project_manager'       => $request->project_manager,
            'no_spk'                => $request->no_spk,
            'tanggal'               => $request->tanggal,
            'prioritas'             => $request->prioritas,
            'waktu_penyelesaian'    => $request->waktu_penyelesaian,
            'pic' => $request->pic,
            'dokumen_pendukung_type' => $request->dokumen_pendukung_type, // Tipe dokumen pendukung
            'dokumen_pendukung_file' => $dokumen_pendukung_file, // Nama file dokumen pendukung
            'file_pendukung_lainnya' => $request->file_pendukung_lainnya,
        ]);

        // Return response
        return redirect(route('suratPerintahKerja.index'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Temukan Surat_perintah_kerja berdasarkan ID
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);

        // Periksa apakah Surat_perintah_kerja ditemukan
        if (!$surat_Perintah_Kerja) {
            return redirect()->back()->with('error', 'Data Surat Perintah Kerja tidak ditemukan!');
        }

        // Hapus gambar terkait jika ada
        if ($surat_Perintah_Kerja->dokumen_pendukung_file) {
            Storage::delete('public/posts/images/' . basename($surat_Perintah_Kerja->dokumen_pendukung_file));
        }

        // Hapus Surat_perintah_kerja
        $surat_Perintah_Kerja->delete();

        // Kembalikan respons
        return redirect()->route('surat_perintah_kerja.index')->with('success', 'Data Surat Perintah Kerja berhasil dihapus.');
    }

    /**
     * exportPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function exportPDF($id)
    {
        // Retrieve Surat Perintah Kerja data by ID
        $surat_perintah_kerjas = Surat_perintah_kerja::where('id', (int)$id)->get();
        // Load view for PDF
        $pdf = PDF::loadView('suratPerintahKerja.surat_perintah_kerja_pdf', compact('surat_perintah_kerjas'));

        // // Optionally, you can set additional configurations for the PDF
        // $pdf->setPaper('a4', 'landscape');

        // Generate PDF
        // return $pdf->stream();

        return $pdf->download('surat_perintah_kerja.pdf');
    }
}
