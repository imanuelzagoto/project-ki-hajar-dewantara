<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon; // Tambahkan ini
use App\Models\PengajuanDana; // Tambahkan ini
use App\Models\Surat_perintah_kerja; // Tambahkan ini
use Illuminate\Support\Facades\DB; // Tambahkan ini

class HomeController extends Controller
{
    public function index()
    {
        // Data per hari
        $today = Carbon::now()->format('Y-m-d');
        $pengajuan_dana_per_day = PengajuanDana::whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->get();
        $total_pengajuan_dana = $pengajuan_dana_per_day->count();

        $pengajuan_spk_per_day =  Surat_perintah_kerja::whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->get();
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

    public function getPengajuanDanaPerDay()
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::now()->format('Y-m-d');

        // Mengambil data pengajuan dana berdasarkan tanggal hari ini
        $pengajuan_dana_per_day = PengajuanDana::whereDate('created_at', $today)->get();

        return response()->json($pengajuan_dana_per_day);
    }

    // Crud Pengajuan dana
    public function editPengajuanDana($id)
    {
        $pengajuanDana = PengajuanDana::findOrFail($id);
        return view('home.pengajuan-dana.edit_pengajuan_dana', compact('pengajuanDana'));
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


    // Crud Surat Perintah Kerja
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
