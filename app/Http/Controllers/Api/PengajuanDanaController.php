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
            'nama_pemohon' => 'required|string',
            'jabatan_pemohon' => 'required|string',
            'subject' => 'required|string',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string',
            'batas_waktu' => 'required',
            'subtotal' => 'required|numeric',
            'terbilang' => 'required|string',
            'metode_penerimaan' => 'required|string',
            'nomor_rekening' => 'nullable|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $request['tanggal_pengajuan'] = Carbon::createFromFormat('d F Y', $request['tanggal_pengajuan'])->format('Y-m-d');
        $request['batas_waktu'] = $request['batas_waktu'] ? Carbon::createFromFormat('d F Y', $request['batas_waktu'])->format('Y-m-d') : null;
        $pengajuanDana = PengajuanDana::create($request->all());
        $pengajuanDana->nominal = 'Rp. ' . number_format($pengajuanDana->nominal, 0, ',', '.');

        // Buat rekaman
        $pengajuanDanas = PengajuanDana::create([
            'form_number' => 'doc_pd',
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'subtotal' => $request->subtotal,
            'terbilang' => $request->terbilang,
            'metode_penerimaan' => $request->metode_penerimaan,
            'nomor_rekening' => $request->nomor_rekening,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        // Buat nomor dokumen dan update rekaman dengan nomor dokumen
        $datetime = explode('-', $pengajuanDanas->created_at);
        $no_doc = $pengajuanDanas->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $pengajuanDanas->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

        return new PengajuanDanaResource(true, 'Pengajuan Dana Berhasil Disimpan.', $pengajuanDanas);
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
            'subtotal' => 'required|numeric',
            'terbilang' => 'required|string',
            'metode_penerimaan' => 'required|string',
            'nomor_rekening' => 'nullable|string',
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
        $pengajuanDana->nominal = 'Rp. ' . number_format($pengajuanDana->nominal, 0, ',', '.');

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
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.pengajuan_dana_pdf', compact('pengajuan_danas'));
        return $pdf->stream("", array("Attachment" => false));
    }
}
