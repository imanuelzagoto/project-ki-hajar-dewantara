<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Surat_perintah_kerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SuratPerintahKerjaResource;
use Carbon\Carbon;

class SuratPerintahKerjaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $suratPerintahKerjas = Surat_perintah_kerja::latest()->paginate(10);
        return new SuratPerintahKerjaResource(true, 'List Data Surat Perintah Kerja', $suratPerintahKerjas);
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

        // Manipulasi tanggal 'tanggal' sebelum membuat surat perintah kerja
        $request['tanggal'] = Carbon::createFromFormat('d/m/Y', $request['tanggal'])->format('Y-m-d');

        // Manipulasi tanggal 'waktu_penyelesaian' sebelum membuat surat perintah kerja
        $request['waktu_penyelesaian'] = $request['waktu_penyelesaian'] ? Carbon::createFromFormat('d/m/Y', $request['waktu_penyelesaian'])->format('Y-m-d') : null;


        // Handle file upload if exists
        if ($request->hasFile('dokumen_pendukung_file')) {
            $destinationPath = '/posts/images';
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file')->hashName();
            $request->file('dokumen_pendukung_file')->move(public_path($destinationPath), $dokumen_pendukung_file);
        } else {
            $dokumen_pendukung_file = null;
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
            'tanggal' => $request->tanggal,
            'prioritas' => $request->prioritas,
            'waktu_penyelesaian' => $request->waktu_penyelesaian,
            'pic' => $request->pic,
            'dokumen_pendukung_type' => $request->dokumen_pendukung_type,
            'dokumen_pendukung_file' => $dokumen_pendukung_file,
            'file_pendukung_lainnya' => $request->file_pendukung_lainnya,
        ]);

        // Return response
        return new SuratPerintahKerjaResource(true, 'Data Surat Perintah Kerja Berhasil Ditambahkan!', $surat_Perintah_Kerja);
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
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);

        // Check if the Surat_perintah_kerja exists
        if ($surat_Perintah_Kerja) {
            return new SuratPerintahKerjaResource(true, 'Detail Data Surat Perintah Kerja!', $surat_Perintah_Kerja);
        } else {
            return response()->json(['message' => 'Data surat perintah Kerja tidak ditemukan!'], 404);
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
        return new SuratPerintahKerjaResource(true, 'Data Surat perintah Kerja Berhasil Diubah!', $surat_Perintah_Kerja);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find the Surat_perintah_kerja by ID
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);

        // Check if the Surat_perintah_kerja exists
        if (!$surat_Perintah_Kerja) {
            return response()->json(['message' => 'Data Surat perintah Kerja tidak ditemukan!'], 404);
        }

        // Delete the associated image if it exists
        if ($surat_Perintah_Kerja->dokumen_pendukung_file) {
            Storage::delete('public/posts/images/' . basename($surat_Perintah_Kerja->dokumen_pendukung_file));
        }

        // Delete the Surat_perintah_kerja
        $surat_Perintah_Kerja->delete();

        // Return response
        return response()->json(['message' => 'Data surat perintah Kerja berhasil dihapus!', 'success' => true, 'data' => null], 200);
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
        $pdf = PDF::loadView('surat_perintah_kerja.surat_perintah_kerja_pdf', compact('surat_perintah_kerjas'));

        // // Optionally, you can set additional configurations for the PDF
        // $pdf->setPaper('a4', 'landscape');

        // Generate PDF
        // return $pdf->stream();

        return $pdf->download('surat_perintah_kerja.pdf');
    }
}
