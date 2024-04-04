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
        // return view('PengajuanDana.index');
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
            'jabatan_pemohon' => 'required|string',
            'subject' => 'required|string',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string',
            'batas_waktu' => 'required|date_format:d F Y',
            'total_dana' => 'required|numeric',
            'metode_penerimaan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date_format:d F Y',
            'no_doc' => 'required|string',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $request['tanggal_pengajuan'] = Carbon::createFromFormat('d F Y', $request['tanggal_pengajuan'])->format('Y-m-d');
        $request['batas_waktu'] = $request['batas_waktu'] ? Carbon::createFromFormat('d F Y', $request['batas_waktu'])->format('Y-m-d') : null;
        $pengajuanDana = PengajuanDana::create($request->all());
        $pengajuanDana->dana_yang_dibutuhkan = 'Rp. ' . number_format($pengajuanDana->dana_yang_dibutuhkan, 0, ',', '.');

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
            'jabatan_pemohon' => 'required|string',
            'subject' => 'required|string',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string',
            'batas_waktu' => 'required|date_format:d F Y',
            'total_dana' => 'required|numeric',
            'metode_penerimaan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date_format:d F Y',
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

        $request['tanggal_pengajuan'] = Carbon::createFromFormat('d F Y', $request['tanggal_pengajuan'])->format('Y-m-d');
        $request['batas_waktu'] = $request['batas_waktu'] ? Carbon::createFromFormat('d F Y', $request['batas_waktu'])->format('Y-m-d') : null;
        $pengajuanDana->update($request->all());
        $pengajuanDana->dana_yang_dibutuhkan = 'Rp. ' . number_format($pengajuanDana->dana_yang_dibutuhkan, 0, ',', '.');

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
        $pdf = PDF::loadView('pengajuanDana.pengajuan_dana_pdf', compact('pengajuan_danas'));
        // // Optionally, you can set additional configurations for the PDF
        // $pdf->setPaper('a4', 'landscape');
        // Generate PDF
        // return $pdf->stream();
        return $pdf->stream("", array("Attachment" => false));
        // return $pdf->download('pengajuan_dana.pdf');
    }
}
