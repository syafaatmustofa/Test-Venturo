<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $menu= json_decode(file_get_contents("http://tes-web.landa.id/intermediate/menu"));
        // $transaksi= json_decode(file_get_contents("http://tes-web.landa.id/intermediate/transaksi?tahun=2021"));

        return view('menu');
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
        //tampilkan menu
        $tahun = $request->tahun; //tahun
        $menu= json_decode(file_get_contents("http://tes-web.landa.id/intermediate/menu")); //api menu
        $transaksi= json_decode(file_get_contents("http://tes-web.landa.id/intermediate/transaksi?tahun=".$tahun)); //api transaksi
        $nilai = 0;

        if ($request->tahun){
            foreach ($transaksi as $resulttotal) {
                $nilai += $resulttotal->total;
            }
        }
        
        // perulangan menu
        foreach ($menu as $item) {
            for ($i=1; $i <= 12; $i++) { 
                $result[$item->menu][$i] = 0;
            }
        }
        // perulangan transaksi berdasarkan bulan
        foreach ($transaksi as $item2) {
            $bulan = date('n',strtotime($item2->tanggal));
            $result[$item2->menu][$bulan] += $item2->total;
        }


        // mengambil jumlah total perbulan
        foreach ($transaksi as $jumlahan) {
            for ($i = 1; $i <= 12; $i++) {
                $jumlah[$i] = 0;
            }
        }

        // mengitung jumlah total perbulan
        foreach ($transaksi as $bulan) {
            $hari = date('n', strtotime($bulan->tanggal));
            $jumlah[$hari] += $bulan->total;
        }
        // Mmengambil total tiap menu
        foreach ($menu as $tiapmenu) {
            $jumlahmenu[$tiapmenu->menu] = 0;
        }

        // menghitung total tiap menu
        foreach ($transaksi as $jumlahtransaksi) {
            $jumlahmenu[$jumlahtransaksi->menu] += $jumlahtransaksi->total;
        }


        // menghitung total keseluruhan
        if ($request->tahun) {
            foreach ($transaksi as $hasil) {
                $nilai += $hasil->total;
            }
        }

        // dd($tahun);        
        return view('menu', compact('menu','result','transaksi', 'tahun', 'nilai', 'jumlah', 'jumlahmenu','tahun'));
        // dd($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
