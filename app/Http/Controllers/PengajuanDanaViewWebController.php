<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PengajuanDanaViewWebController extends Controller
{

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
            'batas_waktu' => 'required|date_format:d F Y',
            'nominal' => 'required|numeric',
            'terbilang' => 'required|string',
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
        $pengajuanDanas = PengajuanDana::create($request->all());
        $pengajuanDanas->nominal = 'Rp. ' . number_format($pengajuanDanas->nominal, 0, ',', '.');

        // Create the record
        $pengajuanDanas = PengajuanDana::create([
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'nominal' => $request->nominal,
            'terbilang' => $request->terbilang,
            'metode_penerimaan' => $request->metode_penerimaan,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => $request->no_doc,
            'revisi' => $request->revisi,
        ]);

        return redirect(route('pengajuanDana.index'));
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
            'batas_waktu' => 'required|date_format:d F Y',
            'nominal' => 'required|numeric',
            'terbilang' => 'required|string',
            'metode_penerimaan' => 'required|string',
            'catatan' => 'nullable|string',
            'tanggal_pengajuan' => 'required|date_format:d F Y',
            'no_doc' => 'required|string',
            'revisi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pengajuanDanas = PengajuanDana::find($id);

        if (!$pengajuanDanas) {
            return response()->json(['message' => 'Pengajuan Dana tidak ditemukan!'], 404);
        }
        $request['tanggal_pengajuan'] = Carbon::createFromFormat('d F Y', $request['tanggal_pengajuan'])->format('Y-m-d');
        $request['batas_waktu'] = $request['batas_waktu'] ? Carbon::createFromFormat('d F Y', $request['batas_waktu'])->format('Y-m-d') : null;
        $pengajuanDanas->update($request->all());
        $pengajuanDanas->nominal = 'Rp. ' . number_format($pengajuanDanas->nominal, 0, ',', '.');

        $pengajuanDanas->update([
            'nama_pemohon' => $request->nama_pemohon,
            'jabatan_pemohon' => $request->jabatan_pemohon,
            'subject' => $request->subject,
            'tujuan' => $request->tujuan,
            'lokasi' => $request->lokasi,
            'batas_waktu' => $request->batas_waktu,
            'nominal' => $request->nominal,
            'terbilang' => $request->terbilang,
            'metode_penerimaan' => $request->metode_penerimaan,
            'catatan' => $request->catatan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'no_doc' => $request->no_doc,
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
