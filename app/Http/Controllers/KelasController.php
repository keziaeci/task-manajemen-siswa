<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Kelas.index',[
            'kelases' =>  Kelas::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        // $data = $request->validated();
        $kelas = Kelas::create($request->validated());
        // $validator = Validator::make($request->all(),[
        //     'grade' => 'required',
        //     'name' => 'required|unique:kelas,name'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([])
        // }
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $kelas
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Kelas',
            'data'    => $kelas  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        // $request->validated();
        $kelas->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $kelas
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
