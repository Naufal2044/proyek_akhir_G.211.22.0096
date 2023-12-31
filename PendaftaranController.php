<?php

namespace App\Http\Controllers;

use view;
use index;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranController;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $tanggal_awal = $request->get('tanggal_awal', date('Y-m-1'));
        $tanggal_akhir = $request->get('tanggal_akhir', date('Y-m-d'));
        $status = $request->get('status', 'DAFTAR');
        $pendaftarans = Pendaftaran::where('tanggal_pendaftaran','>=',$tanggal_awal)
        ->where('tanggal_pendaftaran', '<=', $tanggal_akhir)
        ->when(($status=='SEMUA' ? '' : $status),function($query, $status){
        return $query->where('status', $status);
        })->where(function($query) use($q) {
        $query->when($q,function($query, $q){
        return $query->whereHas('prodi', function($query) use ($q){
        $query->where('nama_prodi', 'like', '%'.$q.'%');
        })->orWhere('nama_lengkap', 'like', '%'.$q.'%')
        ->orWhere('alamat', 'like', '%'.$q.'%')
        ->orWhere('kota', 'like', '%'.$q.'%')
        ->orWhere('asal_sekolah', 'like', '%'.$q.'%');
        });
        })
        ->paginate()->withQueryString();
        return view('pendaftaran.index', ['pendaftaran' => $pendaftarans, 'tanggal_awal'
        => $tanggal_awal
        , 'tanggal_akhir' => $tanggal_akhir, 'status' => $status, 'q' => $q]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodis = Prodi::with('fakultas')->get();
        return view('pendaftaran.create', ['prodi' => $prodis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_lengkap' => 'required',
        'alamat' => 'required',
        'kota' => 'required',
        'tanggal_lahir' => 'required|date',
        'asal_sekolah' => 'required',
        'ijazah_url' => 'required|image',
        'prodi_id' => 'required|exists:prodis,id',
        ]);
        $data = $request->all();
        $data['ijazah_url'] = $request->file('ijazah_url')
        ->store('assets/ijazah', 'public');
        $data['status'] = 'DAFTAR';
        $data['tanggal_pendaftaran'] = Carbon::today();
        $data['user_id'] = Auth::user()->id;
        Pendaftaran::create($data);
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function terima(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->status = 'DITERIMA';
        $pendaftaran->save();
        return redirect('/pendaftaran');
    }

    public function tolak(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->status = 'TIDAK DITERIMA';
        $pendaftaran->save();
        return redirect('/pendaftaran');
    }
}
