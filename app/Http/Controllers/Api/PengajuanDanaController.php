<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PengajuanDanaResource;
use Carbon\Carbon;

class PengajuanDanaController extends Controller
{
    public function index()
    {
        $pengajuanDanas = PengajuanDana::latest()->paginate(10);
        return new PengajuanDanaResource(true, 'List Data Pengajuan Dana', $pengajuanDanas);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemohon' => 'required|string',
            'subject' => 'required|string',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string',
            'jangka_waktu' => 'required|date_format:d F Y',
            'dana_yang_dibutuhkan' => 'required|numeric',
            'no_rekening' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal' => 'required|date_format:d F Y',
            'no_doc' => 'required|string',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Manipulasi tanggal 'tanggal' sebelum memperbarui data surat perintah kerja
        $request['tanggal'] = Carbon::createFromFormat('d F Y', $request['tanggal'])->format('Y-m-d');

        // Manipulasi tanggal 'waktu_penyelesaian' sebelum memperbarui data surat perintah kerja
        $request['jangka_waktu'] = $request['jangka_waktu'] ? Carbon::createFromFormat('d F Y', $request['jangka_waktu'])->format('Y-m-d') : null;

        $pengajuanDana = PengajuanDana::create($request->all());

        return new PengajuanDanaResource(true, 'Pengajuan Dana Berhasil Disimpan.', $pengajuanDana);
    }

    /**
     * show
     *
     * @param  mixed $PengajuanDana
     * @return void
     */

    public function show($id)
    {
        $pengajuanDana = PengajuanDana::find($id);

        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        return new PengajuanDanaResource(true, 'Detail Data Pengajuan Dana.', $pengajuanDana);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $PengajuanDana
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemohon' => 'required|string',
            'subject' => 'required|string',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string',
            'jangka_waktu' => 'required|date_format:d F Y',
            'dana_yang_dibutuhkan' => 'required|numeric',
            'no_rekening' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal' => 'required|date_format:d F Y',
            'no_doc' => 'required|string',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pengajuanDana = PengajuanDana::find($id);

        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        // Manipulasi tanggal 'tanggal' sebelum memperbarui data surat perintah kerja
        $request['tanggal'] = Carbon::createFromFormat('d F Y', $request['tanggal'])->format('Y-m-d');

        // Manipulasi tanggal 'waktu_penyelesaian' sebelum memperbarui data surat perintah kerja
        $request['jangka_waktu'] = $request['jangka_waktu'] ? Carbon::createFromFormat('d F Y', $request['jangka_waktu'])->format('Y-m-d') : null;

        $pengajuanDana->update($request->all());

        return new PengajuanDanaResource(true, 'Pengajuan Dana Berhasil Diperbarui.', $pengajuanDana);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $pengajuanDana = PengajuanDana::find($id);

        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        $pengajuanDana->delete();

        return response()->json(['message' => 'Pengajuan Dana berhasil dihapus.'], 200);
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
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        // Load view for PDF
        $pdf = PDF::loadView('PD.pengajuan_dana_pdf', compact('pengajuan_danas'));

        // // Optionally, you can set additional configurations for the PDF
        // $pdf->setPaper('a4', 'landscape');

        // Generate PDF
        // return $pdf->stream();

        return $pdf->download('pengajuan_dana.pdf');
    }
}
