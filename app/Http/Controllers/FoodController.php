<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // MELIHAT SEMUA MENU -> USER
        $food = Food::all();
        return $food;
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
        // MENAMBAH MAKANAN -> ADMIN
        $food = new Food();
        $food->nama_makanan = $request->input('nama_makanan');
        $food->deskripsi = $request->input('deskripsi');
        $food->varian = $request->input('varian');
        $food->harga = $request->input('harga');
        $food->save();

        return response()->json([
            'success' => 201,
            'message' => 'data saved!',
            'data' => $food
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
        // MENCARI MAKANAN -> USER
        $food = Food::find($id);

        if ($food) {
            return response()->json([
                'status'=> 200,
                'data' => $food
            ], 200);
        } else {
            return respnse()->json([
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
        // MENGUPDATE MAKANAN -> ADMIN
        $food = Food::find($id);
        if($food){
            $food -> nama_makanan = $request -> nama_makanan ? $request -> nama_makanan : $food -> nama_makanan;
            $food -> deskripsi = $request -> deskripsi ? $request -> deskripsi : $food -> deskripsi;
            $food -> varian = $request -> varian ? $request -> varian : $food -> varian;
            $food -> harga = $request -> harga ? $request -> harga : $food -> harga;
            $food -> save();
            return response()->json([
                'status' => 200,
                'data' => $food
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
        // MENGHAPUS MAKANAN -> ADMIN
        $food = Food::where('id', $id)->first();
        if($food){
            $food->delete();
            return response()->json([
                'status'=> 200,
                'data' => $food,
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
