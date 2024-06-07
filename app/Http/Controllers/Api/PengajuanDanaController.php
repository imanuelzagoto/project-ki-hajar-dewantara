<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PengajuanDanaResource;
use App\Models\ItemPengajuanDana;
use Illuminate\Support\Facades\Session;

class PengajuanDanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->get();
        return new PengajuanDanaResource(true, 'List Data Pengajuan Dana', $pengajuanDanas);
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
            'batas_waktu' => 'required|date',
            'subtotal' => 'required|integer',
            'total.*' => 'required|integer',
            'nama_item.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'satuan.*' => 'required|string',
            'harga.*' => 'required|integer',
            'terbilang' => 'required|string',
            'tunai' => 'required|string',
            'non_tunai' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $userData = Session::get('user');
        $userId = $userData['id'];
        $pengajuanDanas = PengajuanDana::create([
            'form_number' => 'doc_pd',
            'user_id' => $userId,
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'subtotal' => $request->subtotal,
            'total' => $request->total,
            'terbilang' => $request->terbilang,
            'tunai' => $request->tunai,
            'non_tunai' => $request->non_tunai,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        $datetime = explode('-', $pengajuanDanas->created_at);
        $no_doc = $pengajuanDanas->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $pengajuanDanas->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

        $items = $request->only('nama_item', 'jumlah', 'satuan', 'harga');
        $subtotal = 0;
        foreach ($items['nama_item'] as $key => $item) {
            $subtotal_item = $items['jumlah'][$key] * $items['harga'][$key];
            $subtotal += $subtotal_item;
            $pengajuanDanas->items()->create([
                'nama_item' => $item,
                'jumlah' => $items['jumlah'][$key],
                'satuan' => $items['satuan'][$key],
                'harga' => $items['harga'][$key],
                'total' => $subtotal_item,
            ]);
        }
        if ($subtotal !== $request->subtotal) {
            return response()->json(['error' => 'Total keseluruhan tidak sama dengan subtotal.'], 422);
        }

        return new PengajuanDanaResource(true, 'Pengajuan Dana Berhasil Disimpan.', $pengajuanDanas);
    }

    public function show($id)
    {
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.show', compact('pengajuan_danas'));
        $pdf->setPaper(array(0, 0, 899.45, 1200));
        return $pdf->stream();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pemohon' => 'required|string',
            'jabatan_pemohon' => 'required|string',
            'subject' => 'required|string',
            'tujuan' => 'required|string',
            'lokasi' => 'required|string',
            'batas_waktu' => 'required|date',
            'subtotal' => 'required|integer',
            'total.*' => 'required|integer',
            'nama_item.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'satuan.*' => 'required|string',
            'harga.*' => 'required|integer',
            'terbilang' => 'required|string',
            'tunai' => 'required|string',
            'non_tunai' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pengajuanDana = PengajuanDana::find($id);

        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        // Ambil data item dari request
        $nama_items = $request->input('nama_item');
        $jumlahs = $request->input('jumlah');
        $satuans = $request->input('satuan');
        $hargas = $request->input('harga');

        // Hapus item yang sudah ada untuk entri pengajuan dana ini
        $pengajuanDana->items()->delete();

        $subtotal = 0;

        // Simpan item yang baru dan hitung subtotal
        foreach ($nama_items as $key => $nama_item) {
            $item = new ItemPengajuanDana();
            $item->nama_item = $nama_item;
            $item->jumlah = $jumlahs[$key];
            $item->satuan = $satuans[$key];
            $item->harga = $hargas[$key];
            $item->total = $jumlahs[$key] * $hargas[$key];
            $subtotal += $item->total;
            $pengajuanDana->items()->save($item);
        }

        // Update data pengajuan dana dengan subtotal yang baru dihitung
        $pengajuanDana->update([
            'form_number' => 'doc_pd',
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'subtotal' => $request->subtotal,
            'total' => $request->total,
            'terbilang' => $request->terbilang,
            'tunai' => $request->tunai,
            'non_tunai' => $request->non_tunai,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        $datetime = explode('-', $pengajuanDana->created_at);
        $no_doc = $pengajuanDana->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $pengajuanDana->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

        return new PengajuanDanaResource(true, 'Pengajuan Dana Berhasil Diperbarui.', $pengajuanDana);
    }


    public function destroy($id)
    {
        $pengajuanDana = PengajuanDana::find($id);

        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }
        $pengajuanDana->delete();
        return response()->json(['message' => 'Pengajuan Dana berhasil dihapus.'], 200);
    }


    public function exportPDF($id)
    {

        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.pengajuan_dana_pdf', compact('pengajuan_danas'));
        $pdf->setPaper(array(0, 0, 899.45, 1200));
        return $pdf->stream("", array("Attachment" => false));
    }
}
