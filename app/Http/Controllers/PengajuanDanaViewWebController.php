<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use Illuminate\Support\Facades\Validator;

class PengajuanDanaViewWebController extends Controller
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
        $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->get();
        return view('pengajuanDana.index', compact('pengajuanDanas'));
    }

    public function create()
    {
        return view('pengajuanDana.create');
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
            'batas_waktu' => 'required|date',
            'subtotal' => 'required|integer',
            'total' => 'required|integer',
            'nama_item' => 'required|string',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
            'terbilang' => 'required|string',
            'metode_penerimaan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
            'total' => $request->total,
            'nama_item' => $request->nama_item,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'terbilang' => $request->terbilang,
            'metode_penerimaan' => $request->metode_penerimaan,
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

        return redirect()->route('pengajuanDana.index');
    }






    /**
     * show
     *
     * @param  mixed $PengajuanDana
     * @return void
     */

    public function show($id)
    {
        // Find surat perintah kerja by ID
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.show', compact('pengajuan_danas'));
        $pdf->setPaper(array(0, 0, 609.45, 841.7), 'landscape');
        return $pdf->stream();
    }

    public function edit($id)
    {
        // find data spk berdasarkan id
        $pengajuanDanas = PengajuanDana::find($id);
        // check if the spk exists
        if ($pengajuanDanas) {
            return view('pengajuanDana.edit')->with('pengajuanDanas', $pengajuanDanas);
        } else {
            return view('page404');
        }
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
            'batas_waktu' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'nama_item' => 'required|string',
            'jumlah' => 'required|string',
            'harga' => 'required|numeric',
            'terbilang' => 'required|string',
            'metode_penerimaan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pengajuanDanas = PengajuanDana::find($id);

        if (!$pengajuanDanas) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        $pengajuanDanas->update([
            'form_number' => 'doc_pd',
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'subtotal' => $request->subtotal,
            'total' => $request->total,
            'nama_item' => $request->total,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'terbilang' => $request->terbilang,
            'metode_penerimaan' => $request->metode_penerimaan,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            // 'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        return redirect(route('pengajuanDana.index'));
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

        return redirect(route('pengajuanDana.index'));
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
