<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.data.kecamatan', compact('kecamatans'));
    }
    public function desa($name)
    {
        $kecamatans = Kecamatan::where('name', $name)->select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.data.desa', compact('kecamatans'));
    }
    public function tps($name)
    {
        $desas = Desa::where('name', $name)->select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.data.tps', compact('desas'));
    }

    // get Desa From Database
    public function getDesas(Request $request)
    {
        $id_kecamatan = $request->input('id_kecamatan');
        $kecamatans = Kecamatan::where('id', $id_kecamatan)->select(['id','name','slug'])->get();

        foreach ($kecamatans as $kecamatan) {
            foreach ($kecamatan->desa as $desa) {
                echo "<option value='$desa->id'>$desa->name</option>";
           }
        }
    }

}
