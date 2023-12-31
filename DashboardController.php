<?php

namespace App\Http\Controllers;

use index;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){ 
        if(Auth::user()->role=='CAMABA'){
        $pendaftaran = Pendaftaran::whereRaw('user_id=?', 
        [Auth::user()->id])->first();
        return view('dashboard.camabaindex', ['pendaftaran' => $pendaftaran]);
        }else{
        $daftar = Pendaftaran::where('status', 'DAFTAR')->count();
        $batas = Carbon::today()->subMonths(1);
        $terima = Pendaftaran::where('tanggal_pendaftaran', '>=', $batas)
        ->where('status', 'DITERIMA')->count();
        $tidak_diterima = Pendaftaran::where('tanggal_pendaftaran', '>=', $batas)
        ->where('status', 'TIDAK DITERIMA')->count();
        return view('dashboard.universitasindex', ['daftar' => $daftar, 
        'terima' => $terima, 'tidak_diterima' => $tidak_diterima]);
        }
       }
}
