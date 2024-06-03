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
        // $userrole = $userData['modules']['name'];
        // $userId = $userData['id'];

        // dd($userrole);


        // if ($userrole === 'Super Admin') {
        $today = Carbon::now()->format('Y-m-d');
        $pengajuan_dana_per_day_by_user_id = PengajuanDana::with('items', 'details')
            ->whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        // dd($pengajuan_dana_per_day_by_user_id);

        $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->count();

        $pengajuan_spk_per_day = Surat_perintah_kerja::whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->count();

        // Data per bulan
        $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
        // dd($monthly_pengajuan_spk);
        // } elseif ($userrole === 'user biasa') {
        //     $today = Carbon::now()->format('Y-m-d');
        //     $pengajuan_dana_per_day_by_user_id = PengajuanDana::whereDate('created_at', now()->toDateString())
        //         ->where('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     // dd($pengajuan_dana_per_day_by_user_id);
        //     $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('user_id', $userId)->count();
        //     $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();

        //     $pengajuan_spk_per_day = Surat_perintah_kerja::where('created_at', $today)->orWhere('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();
        //     $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();
        // } elseif ($userrole === 'Driver') {
        //     $today = Carbon::now()->format('Y-m-d');
        //     $pengajuan_dana_per_day_by_user_id = PengajuanDana::whereDate('created_at', now()->toDateString())
        //         ->where('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     // dd($pengajuan_dana_per_day_by_user_id);
        //     $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('user_id', $userId)->count();
        //     $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();

        //     $pengajuan_spk_per_day = Surat_perintah_kerja::where('created_at', $today)->orWhere('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();
        //     $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();
        // } elseif ($userrole === 'General Affair') {
        //     $today = Carbon::now()->format('Y-m-d');
        //     $pengajuan_dana_per_day_by_user_id = PengajuanDana::where('created_at', $today)->where('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();

        //     $pengajuan_spk_per_day = Surat_perintah_kerja::where('created_at', $today)->orWhere('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();
        // } elseif ($userrole === 'Hr') {
        //     $today = Carbon::now()->format('Y-m-d');
        //     $pengajuan_dana_per_day_by_user_id = PengajuanDana::where('created_at', $today)->where('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     $total_pengajuan_dana_by_user_id = PengajuanDana::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_dana_by_user_id = PengajuanDana::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();

        //     $pengajuan_spk_per_day = Surat_perintah_kerja::where('created_at', $today)->orWhere('user_id', $userId)
        //         ->orderBy('id', 'desc')
        //         ->take(5)
        //         ->get();

        //     $total_pengajuan_spk = Surat_perintah_kerja::whereDate('created_at', $today)->where('user_id', $userId)->count();

        //     $monthly_pengajuan_spk = Surat_perintah_kerja::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))->Where('user_id', $userId)
        //         ->groupBy(DB::raw('MONTH(created_at)'))
        //         ->get();
        // }
        return view('home.index')
            ->with('pengajuan_dana_per_day_by_user_id', $pengajuan_dana_per_day_by_user_id)
            ->with('total_pengajuan_dana_by_user_id', $total_pengajuan_dana_by_user_id)
            ->with('monthly_pengajuan_dana_by_user_id', $monthly_pengajuan_dana_by_user_id)

            ->with('pengajuan_spk_per_day', $pengajuan_spk_per_day)
            ->with('total_pengajuan_spk', $total_pengajuan_spk)
            ->with('monthly_pengajuan_spk', $monthly_pengajuan_spk);
    }




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
