<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanDana;
use App\Models\Surat_perintah_kerja;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $pengajuan_dana_table = PengajuanDana::whereDate('created_at', 'LIKE', $today . '%')->get();
        $pengajuan_spk_table = Surat_perintah_kerja::whereDate('created_at', 'LIKE', $today . '%')->get();
        $total_pengajuan_dana = PengajuanDana::whereDate('created_at', 'LIKE', $today . '%')->count();
        $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', 'LIKE', $today . '%')->count();

        return view('home')
            ->with('pengajuan_spk_table', $pengajuan_spk_table)
            ->with('pengajuan_dana_table', $pengajuan_dana_table)
            ->with('total_pengajuan_dana', $total_pengajuan_dana)
            ->with('total_pengajuan_spk', $total_pengajuan_spk);
    }
}
