<?php

namespace App\Http\Controllers\Api;

use App\Models\Surat_perintah_kerja;
use App\Http\Resources\SuratPerintahKerjaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'nama_project' => 'required',
            'user' => 'required',
            'main_contractor' => 'required',
            'project_manager' => 'required',
            'no_spk' => 'required',
            'tanggal' => 'required|date',
            'prioritas' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable|date',
            'dokumen_pendukung_type' => 'nullable|string',
            'dokumen_pendukung_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
            'nama_project' => $request->nama_project,
            'user' => $request->user,
            'main_contractor' => $request->main_contractor,
            'project_manager' => $request->project_manager,
            'no_spk' => $request->no_spk,
            'tanggal' => $request->tanggal,
            'prioritas' => $request->prioritas,
            'waktu_penyelesaian' => $request->waktu_penyelesaian,
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
     * @param  mixed $post
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);

        //return single post as a resource
        return new SuratPerintahKerjaResource(true, 'Detail Data Surat Perintah Kerja!', $surat_Perintah_Kerja);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'kode_project'          => 'required',
            'nama_project'          => 'required',
            'user'                  => 'required',
            'main_contractor'       => 'required',
            'project_manager'       => 'required',
            'no_spk'                => 'required',
            'tanggal'               => 'required|date',
            'prioritas' => 'nullable|string',
            'waktu_penyelesaian' => 'nullable|date',
            'dokumen_pendukung_type' => 'nullable|string',
            'dokumen_pendukung_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
            'nama_project'          => $request->nama_project,
            'user'                  => $request->user,
            'main_contractor'       => $request->main_contractor,
            'project_manager'       => $request->project_manager,
            'no_spk'                => $request->no_spk,
            'tanggal'               => $request->tanggal,
            'prioritas'             => $request->prioritas,
            'waktu_penyelesaian'    => $request->waktu_penyelesaian,
            'dokumen_pendukung_type' => $request->dokumen_pendukung_type, // Tipe dokumen pendukung
            'dokumen_pendukung_file' => $dokumen_pendukung_file, // Nama file dokumen pendukung
            'file_pendukung_lainnya' => $request->file_pendukung_lainnya,
        ]);

        // Return response
        return new SuratPerintahKerjaResource(true, 'Data Surat perintah Kerja Berhasil Diubah!', $surat_Perintah_Kerja);
    }
}
