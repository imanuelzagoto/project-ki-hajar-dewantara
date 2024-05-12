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
    public function index()
    {
        $suratPerintahKerjas = Surat_perintah_kerja::orderBy('created_at', 'desc')->get();
        return new SuratPerintahKerjaResource(true, 'List Data Surat Perintah Kerja', $suratPerintahKerjas);
    }

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


    public function store(Request $request)
    {
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
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dokumen_pendukung_file = null;
        if ($request->hasFile('dokumen_pendukung_file')) {
            $destinationPath = '/posts/images';
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file')->hashName();
            $request->file('dokumen_pendukung_file')->move(public_path($destinationPath), $dokumen_pendukung_file);
        }

        $suratPerintahKerjas = Surat_perintah_kerja::create([
            'form_number' => 'spk',
            'user_id' => $request->user_id,
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

        $datas = Surat_perintah_kerja::where('id', $suratPerintahKerjas->id)->first();
        $datetime = explode('-', $datas->created_at);
        $no_spk = $suratPerintahKerjas->id . '-SPK/SII/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas = Surat_perintah_kerja::where('id', $suratPerintahKerjas->id)->update([
            'no_spk' => $no_spk,
            'form_number' => $no_spk
        ]);
        return new SuratPerintahKerjaResource(true, 'Data Surat Perintah Kerja Berhasil Ditambahkan!', $suratPerintahKerjas);
    }


    public function show($id)
    {

        $suratPerintahKerjas = Surat_perintah_kerja::where('id', (int)$id)->get();
        $pdf = PDF::loadView('suratPerintahKerja.show', compact('suratPerintahKerjas'));
        $pdf->setPaper(array(0, 0, 1010.45, 841.7), 'landscape');
        return $pdf->stream();
    }


    public function update(Request $request, $id)
    {
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
            'file_pendukung_lainnya' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $suratPerintahKerjas = Surat_perintah_kerja::find($id);


        if ($request->hasFile('dokumen_pendukung_file')) {
            $dokumen_pendukung_file = $request->file('dokumen_pendukung_file');
            $dokumen_pendukung_file->storeAs('public/posts/images', $dokumen_pendukung_file->hashName());
            if ($suratPerintahKerjas->dokumen_pendukung_file) {
                Storage::delete('public/posts/images/' . basename($suratPerintahKerjas->dokumen_pendukung_file));
            }
        } else {
            $dokumen_pendukung_file = $suratPerintahKerjas->dokumen_pendukung_file;
        }
        if ($request->dokumen_pendukung_file) {
            $suratPerintahKerjas->update([
                'user_id' => $request->user_id,
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
                'user_id' => $request->user_id,
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

        return new SuratPerintahKerjaResource(true, 'Data Surat perintah Kerja Berhasil Diubah!', $suratPerintahKerjas);
    }

    public function destroy($id)
    {
        $surat_Perintah_Kerja = Surat_perintah_kerja::find($id);
        if (!$surat_Perintah_Kerja) {
            return response()->json(['message' => 'Data Surat perintah Kerja tidak ditemukan!'], 404);
        }
        if ($surat_Perintah_Kerja->dokumen_pendukung_file) {
            Storage::delete('public/posts/images/' . basename($surat_Perintah_Kerja->dokumen_pendukung_file));
        }
        $surat_Perintah_Kerja->delete();
        return response()->json(['message' => 'Data surat perintah Kerja berhasil dihapus!', 'success' => true, 'data' => null], 200);
    }


    public function exportPDF($id)
    {
        $surat_perintah_kerjas = Surat_perintah_kerja::where('id', (int)$id)->get();
        $pdf = PDF::loadView('suratPerintahKerja.surat_perintah_kerja_pdf', compact('surat_perintah_kerjas'));
        return $pdf->stream("", array("Attachment" => false));
    }
}
