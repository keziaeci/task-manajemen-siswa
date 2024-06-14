<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\Kelas;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Guru.index',[
            'gurus' =>  Guru::latest()->get()
        ]);
    }

    function search()  {
        return response()->json([
            'gurus' => Guru::latest()->with('kelas')->filter(request('search'))->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {
        return response()->json([
            'kelases' => Kelas::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        // dd($request);
        $guru = Guru::create($request->validated());
        $guru->kelas()->attach($request->kelas_id);
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $guru
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Guru',
            'data'    => $guru  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Guru',
            'guru'    => $guru,
            'guru_kelas'    => $guru->kelas->pluck('id'),
            'kelases' => Kelas::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        $guru->update($request->validated());
        $guru->kelas()->attach($request->kelas_id);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $guru
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
