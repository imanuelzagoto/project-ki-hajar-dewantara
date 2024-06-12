<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use App\Models\RequestApproval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

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

        $pengajuanDanas = PengajuanDana::with(['details', 'items'])->orderBy('created_at', 'desc')->get();
        return view('pengajuanDana.index', compact('pengajuanDanas'));
        // if ($userrole === 'Super Admin') {
        // $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->get();
        // dd($pengajuanDanas);
        // } elseif ($userrole === 'user biasa') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // } elseif ($userrole === 'Driver') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // } elseif ($userrole === 'General Affair') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // } elseif ($userrole === 'Hr') {
        //     $pengajuanDanas = PengajuanDana::orderBy('created_at', 'desc')->where('user_id', $userId)->get();
        // }
    }

    public function getApproval(Request $request)
    {
        $tags_approval = [];
        $search = $request->input('name');

        $tags_approval = RequestApproval::where('nama', 'LIKE', "%$search%")
            ->orWhere('jabatan', 'LIKE', "%$search%")
            ->get(['id', 'nama', 'jabatan']);


        // Format data untuk ditampilkan dalam select
        $formatted_tags_approval = [];
        foreach ($tags_approval as $tag) {
            $formatted_tags_approval[] = [
                'id' => $tag->id,
                'text' => $tag->nama . ' - ' . $tag->jabatan
            ];
        }

        return response()->json($formatted_tags_approval);
    }

    public function create()
    {
        $token = Session::get('token');
        $curl = curl_init();
        // dd(env('API_MASTER_PROJECT') . 'https://luna.intek.co.id/api/get-project/');
        curl_setopt_array($curl, array(
            // CURLOPT_URL => env('API_MASTER_PROJECT') . 'get-project/',
            CURLOPT_URL => 'https://luna.intek.co.id/api/get-project/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = curl_exec($curl);
        curl_close($curl);
        $projects = json_decode($response, true)['data'];

        $lastId = PengajuanDana::orderBy('id', 'desc')->first()->id ?? 0;
        $nextId = $lastId + 1;
        $currentYear = date('Y');
        $currentMonth = date('m');
        $no_doc = $nextId . '/FPD/ADM/' . $this->numberToRomanRepresentation($currentMonth) . '/' . $currentYear;
        $tags_approval_data = RequestApproval::all();
        // dd($projects);
        return view('pengajuanDana.create', compact('no_doc', 'tags_approval_data', 'projects'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project' =>  'nullable|string',
            'code' => 'nullable|string',
            'nama_pemohon' => 'required|string',
            'jabatan_pemohon' => 'required|string',
            'pemeriksa' => 'required|array',
            'persetujuan' => 'required|array',
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

        $code = $request->input('code');

        // Hanya ambil ID dari tags_approval
        $pemeriksa_ids = array_map('intval', $request->input('pemeriksa'));
        $persetujuan_ids = array_map('intval', $request->input('persetujuan'));

        // Mengambil data pengguna dari sesi dan ID
        $userData = Session::get('user');
        $userId = $userData['id'];

        $pengajuanDanas = PengajuanDana::create([
            'form_number' => 'doc_pd',
            'user_id' => $userId,
            'project' => $request->project,
            'code' => $code,
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'pemeriksa' => json_encode($pemeriksa_ids),
            'persetujuan' => json_encode($persetujuan_ids),
            'subject' => $request->subject,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        // dd($pengajuanDanas);
        $datas_no_doc = PengajuanDana::where('id', $pengajuanDanas->id)->first();
        $datetime = explode('-', $datas_no_doc->created_at);
        // $no_doc = $pengajuanDanas->id . '/FPD/' . $userrole . '/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $no_doc = $pengajuanDanas->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas_no_doc = PengajuanDana::where('id', $pengajuanDanas->id)->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

        $pengajuanDanas->details()->create([
            'tujuan' => $request->tujuan, 'lokasi' => $request->lokasi, 'batas_waktu' => $request->batas_waktu, 'subtotal' => $request->subtotal, 'total' => $request->total,
            'terbilang' => $request->terbilang, 'tunai' => $request->tunai, 'non_tunai' => $request->non_tunai, 'nama_bank' => $request->nama_bank, 'catatan' => $request->catatan,
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
                'nama_item' => $item, 'jumlah' => $jumlah, 'satuan' => $items['satuan'][$key],
                'harga' => $harga, 'total' => $subtotal_item,
            ]);
        }
        $pengajuanDanas->update(['subtotal' => $subtotal]);

        return redirect()->route('pengajuanDana.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $pengajuan_danas = PengajuanDana::with('items', 'details')->where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.show', compact('pengajuan_danas'));
        $pdf->setPaper(array(0, 0, 899.45, 1080));
        return $pdf->stream();
    }

    public function edit($id)
    {
        $token = Session::get('token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://luna.intek.co.id/api/get-project/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = curl_exec($curl);
        curl_close($curl);
        $projects = json_decode($response, true)['data'];

        $pengajuanDana = PengajuanDana::with(['details', 'items'])->find($id);
        $tags_approval_data = RequestApproval::all();
        // dd($pengajuanDana->tags_approval);
        if ($pengajuanDana) {
            return view('pengajuanDana.edit', compact('pengajuanDana', 'tags_approval_data', 'projects'));
        } else {
            return view('page404');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'project' =>  'nullable|string',
            'code' => 'nullable|string',
            'nama_pemohon' => 'required|string',
            'jabatan_pemohon' => 'required|string',
            'pemeriksa' => 'required|array',
            'persetujuan' => 'required|array',
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

        $code = $request->input('code');

        $pengajuanDana = PengajuanDana::findOrFail($id);
        if (!$pengajuanDana) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }

        // Hanya ambil ID dari tags_approval
        $pemeriksa_ids = array_map('intval', $request->input('pemeriksa'));
        $persetujuan_ids = array_map('intval', $request->input('persetujuan'));

        $userData = Session::get('user');
        $userId = $userData['id'];
        $pengajuanDana->update([
            'form_number' => 'doc_pd',
            'user_id' => $userId,
            'project' => $request->project,
            'code' => $code,
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'pemeriksa' => json_encode($pemeriksa_ids),
            'persetujuan' => json_encode($persetujuan_ids),
            'subject' => $request->subject,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => 'doc_pd',
            'revisi' => $request->revisi,
        ]);

        $pengajuanDana->details()->update([
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'subtotal' => $request->subtotal,
            'terbilang' => $request->terbilang,
            'tunai' => $request->tunai,
            'non_tunai' => $request->non_tunai,
            'nama_bank' => $request->nama_bank,
            'catatan' => $request->catatan,
        ]);

        $items = $request->only('nama_item', 'jumlah', 'satuan', 'harga');
        $subtotal = 0;
        $pengajuanDana->items()->delete();

        foreach ($items['nama_item'] as $key => $item) {
            $jumlah = intval($items['jumlah'][$key]);
            $harga = intval(str_replace(['Rp.', '.', ','], '', $items['harga'][$key]));
            $subtotal_item = $jumlah * $harga;
            $subtotal += $subtotal_item;

            // Simpan item pengajuan dana yang diperbarui
            $pengajuanDana->items()->create([
                'nama_item' => $item,
                'jumlah' => $jumlah,
                'satuan' => $items['satuan'][$key],
                'harga' => $harga,
                'total' => $subtotal_item,
            ]);
        }

        $pengajuanDana->update(['subtotal' => $subtotal]);

        $datas_no_doc = PengajuanDana::where('id', $pengajuanDana->id)->first();
        $datetime = explode('-', $datas_no_doc->created_at);
        $no_doc = $pengajuanDana->id . '/FPD/ADM/' . $this->numberToRomanRepresentation($datetime[1]) . '/' . $datetime[0];
        $datas_no_doc = PengajuanDana::where('id', $pengajuanDana->id)->update([
            'no_doc' => $no_doc,
            'form_number' => $no_doc
        ]);

        return redirect()->route('pengajuanDana.index')->with(['success' => 'Data Berhasil Diperbarui!']);
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
        $pengajuan_danas = PengajuanDana::with('items', 'details')->where('id', (int)$id)->get();
        $pdf = PDF::loadView('pengajuanDana.pengajuan_dana_pdf', compact('pengajuan_danas'));
        return $pdf->stream("", array("Attachment" => false));
    }
}
