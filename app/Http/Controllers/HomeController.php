<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanDana;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Surat_perintah_kerja;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class HomeController extends Controller
{
    public function index()
    {
        // Data per hari
        $today = Carbon::now()->format('Y-m-d');
        $pengajuan_dana_per_day = PengajuanDana::whereDate('created_at', $today)->get();
        $total_pengajuan_dana = $pengajuan_dana_per_day->count();

        $pengajuan_spk_per_day = Surat_perintah_kerja::whereDate('created_at', $today)->get();
        $total_pengajuan_spk = $pengajuan_spk_per_day->count();

        // Data per bulan
        $monthly_pengajuan_dana = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return view('home.index')
            ->with('pengajuan_spk_per_day', $pengajuan_spk_per_day)
            ->with('pengajuan_dana_per_day', $pengajuan_dana_per_day)
            ->with('total_pengajuan_dana', $total_pengajuan_dana)
            ->with('total_pengajuan_spk', $total_pengajuan_spk)
            ->with('monthly_pengajuan_dana', $monthly_pengajuan_dana)
            ->with('monthly_pengajuan_spk', $monthly_pengajuan_spk);
    }

    // Crud function Pengajuan dana
    public function editPengajuanDana($id)
    {
        $pengajuanDana = PengajuanDana::findOrFail($id);
        return view('home.pengajuan-dana.edit_pengajuan_dana', compact('pengajuanDana'));
    }

    public function updatePengajuanDana(Request $request, $id)
    {
        try {
            $request->validate([
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

            // cek spk berdasarkan id
            $suratPerintahKerja = Surat_perintah_kerja::findOrFail($id);
            $suratPerintahKerja->update($request->all());
            // success
            return redirect()->route('home.index')->with('success', 'Data Surat Perintah Kerja berhasil diperbarui');
        } catch (ModelNotFoundException $exception) {
            // kondisi pengajuan tidak ditemukan (HTTP 404)
            return response()->json(['error' => 'Pengajuan tidak ditemukan'], 404);
        } catch (\Exception $exception) {
            // kondisi jika terjadi kesalahan validasi atau kesalahan lainnya (HTTP 422)
            return response()->json(['error' => 'Validasi gagal atau terjadi kesalahan lainnya'], 422);
        }
    }

    public function showPengajuanDana($id)
    {
        $pengajuanDana = PengajuanDana::findOrFail($id);
        return view('home.pengajuan-dana.show_pengajuan_dana', compact('pengajuanDana'));
    }

    public function destroyPengajuanDana($id)
    {
        $pengajuanDana = PengajuanDana::findOrFail($id);
        $pengajuanDana->delete();
        return redirect()->route('home.index')->with('success', 'Data pengajuan dana berhasil dihapus');
    }

    public function editSuratPerintahKerja($id)
    {
        $suratPerintahKerja = Surat_perintah_kerja::findOrFail($id);
        return view('home.surat-perintah-kerja.edit_spk', compact('suratPerintahKerja'));
    }

    public function showSuratPerintahKerja($id)
    {
        $suratPerintahKerja = Surat_perintah_kerja::findOrFail($id);
        return view('home.surat-perintah-kerja.show_spk', compact('suratPerintahKerja'));
    }
    public function  destroySuratPerintahKerja($id)
    {
        Surat_perintah_kerja::where('id', $id)->delete();
        return redirect()->route('home.index')->with('success', 'Data Surat Perintah Kerja berhasil dihapus.');
    }
}
