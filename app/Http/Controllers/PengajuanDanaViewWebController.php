<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use App\Models\ItemPengajuanDana;
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
            'nama_item.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'harga.*' => 'required|integer',
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

        // Proses untuk menyimpan detail item dinamis
        $items = $request->only('nama_item', 'jumlah', 'harga');
        foreach ($items['nama_item'] as $key => $item) {
            $pengajuanDanas->items()->create([
                'nama_item' => $item,
                'jumlah' => $items['jumlah'][$key],
                'harga' => $items['harga'][$key],
                'total' => $items['jumlah'][$key] * $items['harga'][$key],
            ]);
        }

        return redirect()->route('pengajuanDana.index');
    }


    public function show($id)
    {
        // Find surat perintah kerja by ID
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.show', compact('pengajuan_danas'));
        $pdf->setPaper(array(0, 0, 899.45, 1200));
        return $pdf->stream();
    }

    public function edit($id)
    {
        $pengajuanDanas = PengajuanDana::with('items')->find($id);
        // dd($pengajuanDanas->items);
        if ($pengajuanDanas) {
            return view('pengajuanDana.edit', compact('pengajuanDanas'));
        } else {
            return view('page404');
        }
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
            'nama_item.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'harga.*' => 'required|integer',
            'terbilang' => 'required|string',
            'metode_penerimaan' => 'required|string',
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
        $hargas = $request->input('harga');

        // Hapus item yang sudah ada untuk entri pengajuan dana ini
        $pengajuanDana->items()->delete();

        $subtotal = 0; // Menyimpan subtotal

        // Simpan item yang baru dan hitung subtotal
        foreach ($nama_items as $key => $nama_item) {
            $item = new ItemPengajuanDana(); // Ganti dengan model Anda
            $item->nama_item = $nama_item;
            $item->jumlah = $jumlahs[$key];
            $item->harga = $hargas[$key];
            $item->total = $jumlahs[$key] * $hargas[$key]; // Kalkulasi total
            $subtotal += $item->total; // Tambahkan ke subtotal
            // Simpan item ke dalam pengajuan dana
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
            'subtotal' => $subtotal, // Menggunakan subtotal yang baru dihitung
            'terbilang' => $request->terbilang,
            'metode_penerimaan' => $request->metode_penerimaan,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            // 'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        // Redirect ke halaman index setelah pembaruan berhasil dilakukan
        return redirect(route('pengajuanDana.index'));
    }



    public function destroy($id)
    {
        $pengajuanDana = PengajuanDana::find($id);

        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        $pengajuanDana->delete();

        return redirect(route('pengajuanDana.index'));
    }

    public function exportPDF($id)
    {
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.pengajuan_dana_pdf', compact('pengajuan_danas'));
        return $pdf->stream("", array("Attachment" => false));
    }
}
