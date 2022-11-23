<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // MELIHAT MENU MINUMAN -> USER
        $drink = Drink::all();
        return $drink;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // MENAMBAH MINUMAN -> ADMIN
        $drink = new Drink();
        $drink->nama_minuman = $request->input('nama_minuman');
        $drink->deskripsi = $request->input('deskripsi');
        $drink->varian = $request->input('varian');
        $drink->harga = $request->input('harga');
        $drink->save();

        return response()->json([
            'success' => 201,
            'message' => 'data saved!',
            'data' => $drink
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // MENCARI MINUMAN -> USER
        $drink = Drink::find($id);

        if ($drink) {
            return response()->json([
                'status'=> 200,
                'data' => $drink
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message'=> $id . ' Not Found!'
            ], 404);
        }
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
        // MENGUPDATE MINUMAN -> ADMIN
        $drink = Drink::find($id);
        if($drink){
            $drink -> nama_minuman = $request -> nama_minuman ? $request -> nama_minuman : $drink -> nama_minuman;
            $drink -> deskripsi = $request -> deskripsi ? $request -> deskripsi : $drink -> deskripsi;
            $drink -> varian = $request -> varian ? $request -> varian : $drink -> varian;
            $drink -> harga = $request -> harga ? $request -> harga : $drink -> harga;
            $drink -> save();
            return response()->json([
                'status' => 200,
                'data' => $drink
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message'=> $id . ' Not Found!'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // MENGHAPUS MINUMAN -> ADMIN
        $drink = Drink::where('id', $id)->first();
        if($drink){
            $drink->delete();
            return response()->json([
                'status'=> 200,
                'data' => $drink,
                'message' => 'data deleted!'
            ], 200);
        } else{
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id . 'Not Found!'
            ], 404);
        }
    }
}
