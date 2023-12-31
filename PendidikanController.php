<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodis = Prodi::with('fakultas')->paginate(10);
        return view('prodi.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fakultas = Fakultas::pluck('nama_fakultas', 'id');
        return view('prodi.create', compact('fakultas'));
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
            'nama_prodi' => ['required', 'string', 'max:255'],
            'fakultas_id' => ['required', 'integer', 'exists:fakultas,id'],
        ]);

        Prodi::create($request->all());

        return redirect('/prodi')->with('success', 'Prodi created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prodi = Prodi::with('fakultas')->findOrFail($id);
        return view('prodi.show', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
// Example Controller Code
public function edit($id)
{
    $prodi = Prodi::findOrFail($id);
    $fakultas = Fakultas::all(); // Assuming you want to get all fakultas
    
    return view('prodi.edit', compact('prodi', 'fakultas'));
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
        $request->validate([
            'nama_prodi' => ['required', 'string', 'max:255'],
            'fakultas_id' => ['required', 'integer', 'exists:fakultas,id'],
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());

        return redirect('/prodi')->with('success', 'Prodi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect('/prodi')->with('success', 'Prodi deleted successfully');
    }
}
