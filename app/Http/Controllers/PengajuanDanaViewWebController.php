<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use App\Models\ItemPengajuanDana;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PengajuanDanaViewWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function index(Request $request)
    {
        $userData = Session::get('user');
        $userrole = $userData['modules']['name'];
        $userId = $userData['id'];

        // if ($userrole === 'Super Admin') {
        $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->get();
        // } elseif ($userrole === 'user biasa') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // } elseif ($userrole === 'Driver') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // } elseif ($userrole === 'General Affair') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // } elseif ($userrole === 'Hr') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // }

        return view('pengajuanDana.index', compact('pengajuanDanas'));
    }


    public function create()
    {
        $lastId = PengajuanDana::orderBy('id', 'desc')->first()->id ?? 0;
        $nextId = $lastId + 1;
        $currentYear = date('Y');
        $currentMonth = date('m');
        // $no_doc = $nextId . '/FPD/' . $userrole . '/' . $this->numberToRomanRepresentation($currentMonth) . '/' . $currentYear;
        $no_doc = $nextId . '/FPD/ADM/' . $this->numberToRomanRepresentation($currentMonth) . '/' . $currentYear;
        // dd($no_doc);
        return view('pengajuanDana.create', compact('no_doc'));
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
            'subtotal' => 'required|string',
            'total' => 'required|string',
            'nama_item.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'satuan.*' => 'required|string',
            'harga.*' => 'required|string',
            'terbilang' => 'required|string',
            'tunai' => 'nullable|string',
            'non_tunai' => 'nullable|string',
            'nama_bank' => 'nullable|string',
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
            'nama_bank' => $request->nama_bank,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);
        $datas_no_doc = PengajuanDana::where('id', $pengajuanDanas->id)->first();
        $datetime = explode('-', $datas_no_doc->created_at);
        // $no_doc = $pengajuanDanas->id . '/FPD/' . $userrole . '/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $no_doc = $pengajuanDanas->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas_no_doc = PengajuanDana::where('id', $pengajuanDanas->id)->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

        $items = $request->only('nama_item', 'jumlah', 'satuan', 'harga');
        $subtotal = 0;
        foreach ($items['nama_item'] as $key => $item) {
            $jumlah = intval($items['jumlah'][$key]);
            $harga = intval(str_replace(['Rp.', '.', ','], '', $items['harga'][$key]));
            $subtotal_item = $jumlah * $harga;
            $subtotal += $subtotal_item;

            // Simpan item pengajuan dana
            $pengajuanDanas->items()->create([
                'nama_item' => $item,
                'jumlah' => $jumlah,
                'satuan' => $items['satuan'][$key],
                'harga' => $harga,
                'total' => $subtotal_item,
            ]);
        }
        $pengajuanDanas->update(['subtotal' => $subtotal]);

        return redirect()->route('pengajuanDana.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show($id)
    {
        $pengajuan_danas = PengajuanDana::where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.show', compact('pengajuan_danas'));
        $pdf->setPaper(array(0, 0, 899.45, 1200));
        return $pdf->stream();
    }

    public function edit($id)
    {
        $pengajuanDanas = PengajuanDana::with('items')->find($id);
        $items = $pengajuanDanas->items;
        if ($pengajuanDanas) {
            return view('pengajuanDana.edit', compact('pengajuanDanas', 'items'));
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
            'subtotal' => 'required|string',
            'total' => 'required|string',
            'nama_item.*' => 'required|string',
            'jumlah.*' => 'required|integer',
            'satuan.*' => 'required|string',
            'harga.*' => 'required|string',
            'terbilang' => 'required|string',
            'tunai' => 'nullable|string',
            'non_tunai' => 'nullable|string',
            'nama_bank' => 'nullable|string',
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

        $pengajuanDana->items()->delete();
        $subtotal = 0;

        // Simpan item yang baru dan hitung subtotal
        foreach ($nama_items as $key => $nama_item) {
            $item = new ItemPengajuanDana();
            $item->nama_item = $nama_item;
            $item->jumlah = $jumlahs[$key];
            $item->satuan = $satuans[$key];

            // Mengubah format harga menjadi numerik
            $hargaFloat = (float) str_replace(['Rp.', '.', ','], '', $hargas[$key]);
            $item->harga = $hargaFloat;

            $item->total = $jumlahs[$key] * $hargaFloat;
            $subtotal += $item->total;
            $pengajuanDana->items()->save($item);
        }

        $userData = Session::get('user');
        $userId = $userData['id'];

        // Ubah total sesuai format yang diinginkan
        $totalFloat = (float) str_replace(['Rp.', '.', ','], '', $request->total);
        $formattedTotal = 'Rp. ' . number_format($totalFloat, 0, ',', '.');

        $pengajuanDana->update([
            'form_number' => 'doc_pd',
            'user_id' => $userId,
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'subtotal' => $subtotal,
            'total' => $formattedTotal,
            'terbilang' => $request->terbilang,
            'tunai' => $request->tunai,
            'non_tunai' => $request->non_tunai,
            'nama_bank' => $request->nama_bank,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        $datas_no_doc = PengajuanDana::where('id', $pengajuanDana->id)->first();
        $datetime = explode('-', $datas_no_doc->created_at);
        $no_doc = $pengajuanDana->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas_no_doc = PengajuanDana::where('id', $pengajuanDana->id)->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

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
