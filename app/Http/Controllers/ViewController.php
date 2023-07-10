<?php

namespace App\Http\Controllers;

use App\Models\Rangking;
use App\Models\Keputusan;
use App\Models\Alternatif;
use App\Models\Normalisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function keputusan()
    {
        $keputusan = Keputusan::all();
        return view('ViewTable.keputusan', compact('keputusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function normalisasi()
    {
        $normalisasi = Normalisasi::all();
        return view('ViewTable.normalisasi', compact('normalisasi'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rangking()
    {
        $rangking = Rangking::all();
        return view('ViewTable.rangking', compact('rangking'));
    }
    public function perhitunganNormalisasi(){
    // Mengambil nilai minimum dan maksimum dari setiap kolom
         $minValues = Alternatif::select(
            DB::raw('MIN(harga) as min_harga'),
            DB::raw('MIN(jenis_prosesor) as min_jenis_prosesor'),
            DB::raw('MIN(kapasitas_memori) as min_kapasitas_memori'),
            DB::raw('MIN(tipe_memori) as min_tipe_memori'),
            DB::raw('MIN(kapasitas_harddisk) as min_kapasitas_harddisk')
        )->first();

            $maxValues = Alternatif::select(
            DB::raw('MAX(harga) as max_harga'),
            DB::raw('MAX(jenis_prosesor) as max_jenis_prosesor'),
            DB::raw('MAX(kapasitas_memori) as max_kapasitas_memori'),
            DB::raw('MAX(tipe_memori) as max_tipe_memori'),
            DB::raw('MAX(kapasitas_harddisk) as max_kapasitas_harddisk'),
            DB::raw('MAX(ukuran_layar) as max_ukuran_layar')
        )->first();

        // Mengakses nilai minimum dan maksimum sebagai variabel terpisah
        $minHarga = $minValues->min_harga;
        $minjenis_prosesor = $minValues->min_jenis_prosesor;
        $minkapasitas_memori = $minValues->min_kapasitas_memori;
        $mintipe_memori = $minValues->min_tipe_memori;
        $minkapasitas_harddisk = $minValues->min_kapasitas_harddisk;

        $maxHarga = $maxValues->max_harga;
        $maxjenis_prosesor = $maxValues->max_jenis_prosesor;
        $maxkapasitas_memori = $maxValues->max_kapasitas_memori;
        $maxtipe_memori = $maxValues->max_tipe_memori;
        $maxkapasitas_harddisk = $maxValues->max_kapasitas_harddisk;
        $maxukuran_layar = $maxValues->max_ukuran_layar;

            $results = [];
            $nomor = 0;
            $alternatives = Alternatif::all();

            foreach ($alternatives as $alternative) {
                $harga = $alternative->harga;
                $jenis_prosesor = $alternative->jenis_prosesor;
                $kapasitas_memori = $alternative->kapasitas_memori;
                $tipe_memori = $alternative->tipe_memori;
                $kapasitas_harddisk = $alternative->kapasitas_harddisk;
                $ukuran_layar = $alternative->ukuran_layar;


                // Normalisasi setiap nilai kriteria
                $norm_harga = $minHarga/ $harga;
                $norm_jenis_prosesor =  $jenis_prosesor/$maxjenis_prosesor;
                $norm_kapasitas_memori =  $kapasitas_memori/$maxkapasitas_memori;
                $norm_tipe_memori = $tipe_memori / $maxtipe_memori;
                $norm_kapasitas_harddisk = $kapasitas_harddisk/ $maxkapasitas_harddisk;
                $norm_ukuran_layar = $ukuran_layar/ $maxukuran_layar;


                $nomor++;

                $nama_alt = $alternative->nmalternatif;
                $des = $alternative->deskripsi;
                $results[] = ['nomor' => $nomor, 'nama_alt' => $nama_alt, 'harga' => $norm_harga,'jenis_prosesor' => $norm_jenis_prosesor,
                'kapasitas_memori' => $norm_kapasitas_memori, 'tipe_memori' => $norm_tipe_memori,'kapasitas_harddisk' => $norm_kapasitas_harddisk,'ukuran_layar'=>$norm_ukuran_layar];
                // arsort($results);
            }


            return view('ViewTable.normalisasi', ['results' => collect($results)->sortByDesc('hasil')->values()->all()]);
    }
    public function calculateSAW()
{
    // Mengambil data alternatif
    $alternatives = Alternatif::all();

    // Bobot kriteria
    $weights = [0.30,0.25,0.15,0.10,0.15,0.05];

    $minValues = Alternatif::select(
        DB::raw('MIN(harga) as min_harga'),
        DB::raw('MIN(jenis_prosesor) as min_jenis_prosesor'),
        DB::raw('MIN(kapasitas_memori) as min_kapasitas_memori'),
        DB::raw('MIN(tipe_memori) as min_tipe_memori'),
        DB::raw('MIN(kapasitas_harddisk) as min_kapasitas_harddisk')
    )->first();

        $maxValues = Alternatif::select(
        DB::raw('MAX(harga) as max_harga'),
        DB::raw('MAX(jenis_prosesor) as max_jenis_prosesor'),
        DB::raw('MAX(kapasitas_memori) as max_kapasitas_memori'),
        DB::raw('MAX(tipe_memori) as max_tipe_memori'),
        DB::raw('MAX(kapasitas_harddisk) as max_kapasitas_harddisk'),
        DB::raw('MAX(ukuran_layar) as max_ukuran_layar')
    )->first();

    // Mengakses nilai minimum dan maksimum sebagai variabel terpisah
    $minHarga = $minValues->min_harga;
    $minjenis_prosesor = $minValues->min_jenis_prosesor;
    $minkapasitas_memori = $minValues->min_kapasitas_memori;
    $mintipe_memori = $minValues->min_tipe_memori;
    $minkapasitas_harddisk = $minValues->min_kapasitas_harddisk;

    $maxHarga = $maxValues->max_harga;
    $maxjenis_prosesor = $maxValues->max_jenis_prosesor;
    $maxkapasitas_memori = $maxValues->max_kapasitas_memori;
    $maxtipe_memori = $maxValues->max_tipe_memori;
    $maxkapasitas_harddisk = $maxValues->max_kapasitas_harddisk;
    $maxukuran_layar = $maxValues->max_ukuran_layar;

        $results = [];
        $nomor = 0;
        // $alternatives = Alternatif::all();

        foreach ($alternatives as $alternative) {
            $harga = $alternative->harga;
            $jenis_prosesor = $alternative->jenis_prosesor;
            $kapasitas_memori = $alternative->kapasitas_memori;
            $tipe_memori = $alternative->tipe_memori;
            $kapasitas_harddisk = $alternative->kapasitas_harddisk;
            $ukuran_layar = $alternative->ukuran_layar;


            // Normalisasi setiap nilai kriteria
            $norm_harga = $minHarga/ $harga;
            $norm_jenis_prosesor =  $jenis_prosesor/$maxjenis_prosesor;
            $norm_kapasitas_memori =  $kapasitas_memori/$maxkapasitas_memori;
            $norm_tipe_memori = $tipe_memori / $maxtipe_memori;
            $norm_kapasitas_harddisk = $kapasitas_harddisk/ $maxkapasitas_harddisk;
            $norm_ukuran_layar = $ukuran_layar/ $maxukuran_layar;


        // Hitung hasil SAW
        $hasil = ($norm_harga*$weights[0]) + ($norm_jenis_prosesor * $weights[1]) + ($norm_kapasitas_memori * $weights[2]) +($norm_tipe_memori * $weights[3]) + ($norm_kapasitas_harddisk * $weights[4])+($norm_ukuran_layar * $weights[5]);

        $nomor++;

        $nama_alt = $alternative->nmalternatif;
        $results[] = [
            'nomor' => $nomor,
            'nama_alt' => $nama_alt,
            'hasil' => $hasil,
        ];
    }

    return view('ViewTable.rangking', ['results' => collect($results)->sortByDesc('hasil')->values()->all()]);
}

}