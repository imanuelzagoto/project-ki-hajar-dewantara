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
        return view('pengajuanDana.index');
    }

    public function data()
    {
        $datas = PengajuanDana::select('*');

        return Datatables::of($datas)
            ->addIndexColumn()
            ->addColumn('action', function ($pengajuan_danas) {
                return '
            <div style="display: flex;">
                <a href="' . route('pengajuanDana.edit', $pengajuan_danas->id) . '"
                    class="fas fa-pen btn btn-sm tooltip-container"
                    style="color:#4FD1C5; font-size:20px;">
                    <span class="tooltip-edit">Edit</span>
                </a>
                <a href="' . route('pengajuanDana.show', $pengajuan_danas->id) . '"
                    class="fas fa-eye btn btn-sm tooltip-container"
                    style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                    <span class="tooltip-show">View</span>
                </a>
                <a href="#" 
                        class="fas fa-trash-alt btn btn-sm tooltip-container" 
                        style="color:#F31414; font-size:20px;" 
                        onclick="submitDelete(' . $pengajuan_danas->id . ')">
                        <span class="tooltip-delete">Delete</span>
                    </a>
                    <form id="delete-form-' . $pengajuan_danas->id . '" 
                        action="' . route('pengajuanDana.destroy', $pengajuan_danas->id) . '" 
                        method="POST" style="display: none;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                    </form>
            </div>
        ';
            })
            ->rawColumns(['action'])
            ->make(true);
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

        // Ubah nilai dana_yang_dibutuhkan menjadi format mata uang rupiah
        $pengajuanDana->dana_yang_dibutuhkan = 'Rp. ' . number_format($pengajuanDana->dana_yang_dibutuhkan, 0, ',', '.');

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
        $pengajuanDana = PengajuanDana::find($id);

        // Check if the Surat_perintah_kerja exists
        if ($pengajuanDana) {
            return view('pengajuanDana.show', compact('pengajuanDana'));
        } else {
            return view('page404');
        }
    }

    public function edit($id)
    {
        // find data spk berdasarkan id
        $pengajuanDana = PengajuanDana::find($id);
        // check if the spk exists
        if ($pengajuanDana) {
            return view('pengajuanDana.edit')->with('pengajuanDana', $pengajuanDana);
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

        // Ubah nilai dana_yang_dibutuhkan menjadi format mata uang rupiah
        $pengajuanDana->dana_yang_dibutuhkan = 'Rp. ' . number_format($pengajuanDana->dana_yang_dibutuhkan, 0, ',', '.');

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
        $pdf = PDF::loadView('PD.pengajuan_dana_pdf', compact('pengajuan_danas'));

        // // Optionally, you can set additional configurations for the PDF
        // $pdf->setPaper('a4', 'landscape');

        // Generate PDF
        // return $pdf->stream();

        return $pdf->download('pengajuan_dana.pdf');
    }
}
