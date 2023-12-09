<?php

namespace App\Http\Controllers;

use App\Models\GambarKost;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kost = Kost::with('gambarKost')->get();
        return response()->json([
            'kost' => $kost
        ], 200);
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
        $validator = Validator::make($request->all(), ([
            'nama_kost' => 'required|max:191',
            'jumlah_kamar' => 'required|max:191',
            'kamar_kosong' => 'required|max:191',
            'jenis_kost' => 'required|max:191',
            'fasilitas' => 'required|max:191',
            'harga' => 'required|max:191',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }
        $kost = new Kost;
        $kost->nama_kost = $request->nama_kost;
        $kost->jumlah_kamar = $request->jumlah_kamar;
        $kost->kamar_kosong = $request->kamar_kosong;
        $kost->jenis_kost = $request->jenis_kost;
        $kost->fasilitas = $request->fasilitas;
        $kost->harga = $request->harga;
        $kost->save();

        $arr_gambarkost = [];

        if ($request->hasFile('gambar')) {
            $no = 1;
            foreach ($request->file('gambar') as $gambar) {
                $urlGambar = $this->UploadGambar($gambar, $no);
                $gambarkost = new GambarKost;
                $gambarkost->m_id_kost = $kost->id;
                $gambarkost->url_gambar = $urlGambar;
                $arr_gambarkost[] = $gambarkost->save();

                $no++;
            }
        }
        return response()->json([
            'data' => $kost,
            'gambar' => $arr_gambarkost,
            'data berhasil disimpan'
        ]);
    }

    public function UploadGambar($gambar, $no)
    {
        $gambarName = time() . $no . '.' . $gambar->extension();
        $gambar->move(public_path('images'), $gambarName);

        return asset('images/' . $gambarName);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kost = Kost::with('gambarKost')->find($id);
        if ($kost) {
            return response()->json(['Kost' => $kost], 200);
        } else {
            return response()->json(['Message' => 'data kost tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function edit(Kost $kost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kost' => 'required|max:191',
            'jumlah_kamar' => 'required|max:191',
            'kamar_kosong' => 'required|max:191',
            'jenis_kost' => 'required|max:191',
            'fasilitas' => 'required|max:191',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $kost = Kost::find($id);

        if ($kost) {
            $kost->nama_kost = $request->nama_kost;
            $kost->jumlah_kamar = $request->jumlah_kamar;
            $kost->kamar_kosong = $request->kamar_kosong;
            $kost->jenis_kost = $request->jenis_kost;
            $kost->fasilitas = $request->fasilitas;
            $kost->update();

            $arr_gambarkost = [];
            if ($request->hasFile('gambar')) {
                $no = 1;
                foreach ($request->file('gambar') as $gambar) {
                    $urlGambar = $this->uploadGambar($gambar, $no);
                    $gambarkost = new GambarKost;
                    $gambarkost->m_id_kost = $kost->id;
                    $gambarkost->url_gambar = $urlGambar;
                    $gambarkost->update();

                    $arr_gambarkost[] = $gambarkost;
                    $no++;
                }
            }

            return response()->json([
                'data' => $kost,
                'gambar' => $arr_gambarkost,
                'message' => 'Data berhasil diupdate'
            ]);
            
        } else {
            return response()->json(['error' => 'Kost not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kost = Kost::find($id);

        if ($kost) {
            // Delete associated GambarKost records
            GambarKost::where('m_id_kost', $kost->id)->delete();

            // Delete the Kost
            $kost->delete();

            return response()->json([
                'message' => 'Kost berhasil dihapus'
            ]);
        } else {
            return response()->json(['error' => 'Kost not found'], 404);
        }
    }
}
