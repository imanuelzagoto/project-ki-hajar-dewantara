<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanDana;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Surat_perintah_kerja;

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

        return view('home')
            ->with('pengajuan_spk_per_day', $pengajuan_spk_per_day)
            ->with('pengajuan_dana_per_day', $pengajuan_dana_per_day)
            ->with('total_pengajuan_dana', $total_pengajuan_dana)
            ->with('total_pengajuan_spk', $total_pengajuan_spk)
            ->with('monthly_pengajuan_dana', $monthly_pengajuan_dana)
            ->with('monthly_pengajuan_spk', $monthly_pengajuan_spk);
    }
}
