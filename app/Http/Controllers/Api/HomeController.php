<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\PengajuanDana;
use App\Models\Surat_perintah_kerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userData = Session::get('user');
        $userrole = $userData['modules']['name'];
        $userId = $userData['id'];

        $today = Carbon::now()->format('Y-m-d');
        $pengajuan_dana_per_day_by_user_id = [];
        $total_pengajuan_dana_by_user_id = 0;
        $monthly_pengajuan_dana_by_user_id = [];
        $pengajuan_spk_per_day = [];
        $total_pengajuan_spk = 0;
        $monthly_pengajuan_spk = [];

        // if ($userrole === 'Super Admin') {
        $pengajuan_dana_per_day_by_user_id = PengajuanDana::whereDate('created_at', $today)
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
        // } elseif (in_array($userrole, ['user biasa', 'Driver', 'General Affair', 'Hr'])) {
        //     $pengajuan_dana_per_day_by_user_id = PengajuanDana::whereDate('created_at', $today)
        //         ->where('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
        //         ->where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();

        //     $pengajuan_spk_per_day = Surat_perintah_kerja::whereDate('created_at', $today)
        //         ->where('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
        //         ->where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();
        // }

        return response()->json([
            'pengajuan_dana_per_day_by_user_id' => $pengajuan_dana_per_day_by_user_id,
            'total_pengajuan_dana_by_user_id' => $total_pengajuan_dana_by_user_id,
            'pengajuan_spk_per_day' => $pengajuan_spk_per_day,
            'total_pengajuan_spk' => $total_pengajuan_spk,
            'monthly_pengajuan_dana_by_user_id' => $monthly_pengajuan_dana_by_user_id,
            'monthly_pengajuan_spk' => $monthly_pengajuan_spk,
        ]);
    }
}
