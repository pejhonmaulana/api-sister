<?php

namespace App\Http\Controllers;

use App\Models\GambarKontrakan;
use App\Models\Kontrakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontrakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontrakan = Kontrakan::with('GambarKontrakan')->get();
        return response()->json([
            'kontrakan' => $kontrakan
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
            'alamat_kontrakan' => 'required|max:191',
            'jumlah_kamar_tidur' => 'required|max:191',
            'jumlah_kamar_mandi' => 'required|max:191',
            'fasilitas' => 'required|max:191',
            'harga' => 'required|max:191',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }
        $kontrakan = new Kontrakan;
        $kontrakan->alamat_kontrakan = $request->alamat_kontrakan;
        $kontrakan->jumlah_kamar_tidur = $request->jumlah_kamar_tidur;
        $kontrakan->jumlah_kamar_mandi = $request->jumlah_kamar_mandi;
        $kontrakan->fasilitas = $request->fasilitas;
        $kontrakan->harga = $request->harga;
        $kontrakan->save();

        $arr_gambarkontrakan = [];
        if ($request->hasFile('gambar')) {
            $no = 1;
            foreach ($request->file('gambar') as $gambar) {
                $urlGambar = $this->UploadGambar($gambar, $no);
                $gambarkontrakan = new GambarKontrakan;
                $gambarkontrakan->m_id_kontrakan = $kontrakan->id;
                $gambarkontrakan->url_gambar = $urlGambar;
                $arr_gambarkontrakan[] = $gambarkontrakan->save();

                $no++;
            }
        }
        return response()->json([
            'data' => $kontrakan,
            'gambar' => $arr_gambarkontrakan,
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
     * @param  \App\Models\Kontrakan  $kontrakan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontrakan = Kontrakan::with('gambarKontrakan')->find($id);
        if ($kontrakan) {
            return response()->json(['kontrakan' => $kontrakan], 200);
        } else {
            return response()->json(['Message' => 'data kontrakan tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrakan  $kontrakan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrakan $kontrakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontrakan  $kontrakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ([
            'alamat_kontrakan' => 'required|max:191',
            'jumlah_kamar_tidur' => 'required|max:191',
            'jumlah_kamar_mandi' => 'required|max:191',
            'fasilitas' => 'required|max:191',
            'harga' => 'required|max:191',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }
        $kontrakan = Kontrakan::find($id);
        if ($kontrakan) {

            $kontrakan->alamat_kontrakan = $request->alamat_kontrakan;
            $kontrakan->jumlah_kamar_tidur = $request->jumlah_kamar_tidur;
            $kontrakan->jumlah_kamar_mandi = $request->jumlah_kamar_mandi;
            $kontrakan->fasilitas = $request->fasilitas;
            $kontrakan->harga = $request->harga;
            $kontrakan->update();

            $arr_gambarkontrakan = [];
            if ($request->hasFile('gambar')) {
                $no = 1;
                foreach ($request->file('gambar') as $gambar) {
                    $urlGambar = $this->UploadGambar($gambar, $no);
                    $gambarkontrakan = new GambarKontrakan;
                    $gambarkontrakan->m_id_kontrakan = $kontrakan->id;
                    $gambarkontrakan->url_gambar = $urlGambar;
                    $gambarkontrakan->update();

                    $arr_gambarkontrakan[] = $gambarkontrakan;
                    $no++;
                }
            }
            return response()->json([
                'data' => $kontrakan,
                'gambar' => $arr_gambarkontrakan,
                'data berhasil diupdate'
            ]);
        }else {
            return response()->json(['error' => 'Kontrakan Not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrakan  $kontrakan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kontrakan = Kontrakan::find($id);

        if ($kontrakan) {
            // Delete associated Gambarkontrakan records
            GambarKontrakan::where('m_id_kontrakan', $kontrakan->id)->delete();

            // Delete the kontrakan
            $kontrakan->delete();

            return response()->json([
                'message' => 'kontrakan berhasil dihapus'
            ]);
        } else {
            return response()->json(['error' => 'kontrakan not found'], 404);
        }
    }
}
