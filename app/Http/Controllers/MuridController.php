<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMuridRequest;
use App\Http\Requests\UpdateMuridRequest;
use App\Models\Kelas;
use App\Models\Murid;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Murid.index',[
            'murids' => Murid::latest()->filter(request('search'))->get()
        ]);
    }

    function search()  {
        return response()->json([
            'murids' => Murid::latest()->with('kelas')->filter(request('search'))->get()
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
    public function store(StoreMuridRequest $request)
    {
        $murid = Murid::create($request->validated());
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $murid
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Murid $murid)
    {
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Detail umr$murid',
        //     'data'    => $murid,
        //     'kelases' => Kelas::all()  
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Murid $murid)
    {
        return response()->json([
            'kelases' => Kelas::latest()->get(),
            'murid' => $murid
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMuridRequest $request, Murid $murid)
    {
        $murid->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $murid
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Murid $murid)
    {
        $murid->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
