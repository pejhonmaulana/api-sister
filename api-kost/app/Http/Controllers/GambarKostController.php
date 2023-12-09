<?php

namespace App\Http\Controllers;

use App\Models\GambarKost;
use App\Models\Kost;
use Illuminate\Http\Request;

class GambarKostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(Request $request, $m_id_kost)
    {
        $request->validate([
            'url_gambar' => 'required|url_gambar|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $nama_gambar = time().'.'.$request->url_gambar->extension();
        $request->url_gambar->move(public_path('images'), $nama_gambar);
        $gambar = new GambarKost([
            'm_id_kost' => $m_id_kost,
            'url_gambar' => $nama_gambar
        ]);

        $gambar->save();

        return response()->json([
            'message' => 'data gambar kost disimpan'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambarKost  $gambarKost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarKost  $gambarKost
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarKost $gambarKost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambarKost  $gambarKost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarKost $gambarKost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarKost  $gambarKost
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarKost $gambarKost)
    {
        //
    }
}
