<?php

namespace App\Http\Controllers;

use App\Models\GambarKontrakan;
use Illuminate\Http\Request;

class GambarKontrakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $m_id_kontrakan)
    {
        $request->validate([
            'url_gambar' => 'required|url_gambar|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $nama_gambar = time().'.'.$request->url_gambar->extension();
        $request->url_gambar->move(public_path('images'), $nama_gambar);
        $gambar = new GambarKontrakan([
            'm_id_kontrakan' => $m_id_kontrakan,
            'url_gambar' => $nama_gambar
        ]);

        $gambar->save();

        return response()->json([
            'message' => 'data gambar kontrakan disimpan'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambarKontrakan  $gambarKontrakan
     * @return \Illuminate\Http\Response
     */
    public function show(GambarKontrakan $gambarKontrakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarKontrakan  $gambarKontrakan
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarKontrakan $gambarKontrakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambarKontrakan  $gambarKontrakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarKontrakan $gambarKontrakan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarKontrakan  $gambarKontrakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarKontrakan $gambarKontrakan)
    {
        //
    }
}
