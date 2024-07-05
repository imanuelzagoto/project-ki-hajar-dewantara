<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanDana;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Surat_perintah_kerja;
use Illuminate\Support\Facades\Session;


class HomeViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userData = Session::get('user');
        $userId = $userData['id'];
        $devisionId = $userData['division_id'];
        $today = Carbon::now()->format('Y-m-d');

        // Inisialisasi variabel dengan nilai default
        $pengajuan_dana_per_day_by_user_id = collect();
        $total_pengajuan_dana_by_user_id = 0;
        $pengajuan_spk_per_day = collect();
        $total_pengajuan_spk = 0;
        $monthly_pengajuan_dana_by_user_id = collect();
        $monthly_pengajuan_spk = collect();

        if ($userId == 1 || $userId == 127) {
            $pengajuan_dana_per_day_by_user_id = PengajuanDana::with('items', 'details')
                ->whereDate('created_at', $today)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->count();

            $pengajuan_spk_per_day = Surat_perintah_kerja::whereDate('created_at', $today)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
            $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->count();

            $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();

            $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();
        } else if ($devisionId == "" || $devisionId == 0 || $devisionId == null || $devisionId == "null" || $devisionId == "0") {
            $pengajuan_dana_per_day_by_user_id = PengajuanDana::whereDate('created_at', $today)
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('user_id', $userId)->count();

            $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();

            $pengajuan_spk_per_day = Surat_perintah_kerja::whereDate('created_at', $today)
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

            $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();
        } else {
            $pengajuan_dana_per_day_by_user_id = PengajuanDana::whereDate('created_at', $today)
                ->where('division_id', $devisionId)
                ->take(5)
                ->get();

            $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('division_id', $devisionId)->count();

            $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('division_id', $devisionId)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();

            $pengajuan_spk_per_day = Surat_perintah_kerja::whereDate('created_at', $today)
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

            $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();
        }

        return view('home.index', compact(
            'pengajuan_dana_per_day_by_user_id',
            'total_pengajuan_dana_by_user_id',
            'pengajuan_spk_per_day',
            'total_pengajuan_spk',
            'monthly_pengajuan_dana_by_user_id',
            'monthly_pengajuan_spk'
        ));
    }
}
