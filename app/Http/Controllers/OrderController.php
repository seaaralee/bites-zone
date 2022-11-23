<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // MELIHAT SEMUA PESANAN -> ADMIN
        $order = Order::all();
        return $order;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // MENAMBAH PESANAN -> USER
        $order = new Order();
        $order->tgl_pesan = $request->input('tgl_pesan');
        $order->nama_pelanggan = $request->input('nama_pelanggan');
        $order->alamat = $request->input('alamat');
        $order->metode_bayar = $request->input('metode_bayar');
        $order->pesanan = $request->input('pesanan');
        $order->varian = $request->input('varian');
        $order->jumlah = $request->input('jumlah');
        $order->save();

        return response()->json([
            'success' => 201,
            'message' => 'success add an order!',
            'data' => $order
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
        // MENAMPILKAN DETAIL PESANAN -> ADMIN
        $order = Order::find($id);

        if ($order) {
            return response()->json([
                'status'=> 200,
                'data' => $order
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
        // MENGUPDATE PESANAN -> USER
        $order = Order::find($id);
        if($order){
            $order -> tgl_pesan = $request -> tgl_pesan ? $request -> tgl_pesan : $order -> tgl_pesan;
            $order -> nama_pelanggan = $request -> nama_pelanggan ? $request -> nama_pelanggan : $order -> nama_pelanggan;
            $order -> alamat = $request -> alamat ? $request -> alamat : $order -> alamat;
            $order -> metode_bayar = $request -> metode_bayar ? $request -> metode_bayar : $order -> metode_bayar;
            $order -> pesanan = $request -> pesanan ? $request -> pesanan : $order -> pesanan;
            $order -> varian = $request -> varian ? $request -> varian : $order -> varian;
            $order -> jumlah = $request -> jumlah ? $request -> jumlah : $order -> jumlah;
            $order -> save();
            return response()->json([
                'status' => 200,
                'data' => $order
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
        // MENGHAPUS PESANAN -> USER, ADMIN
        $order = Order::where('id', $id)->first();
        if($order){
            $order->delete();
            return response()->json([
                'status'=> 200,
                'data' => $order,
                'message' => 'order deleted!'
            ], 200);
        } else{
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id . 'Not Found!'
            ], 404);
        }
    }
}
