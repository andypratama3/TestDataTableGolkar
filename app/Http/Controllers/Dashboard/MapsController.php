<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapsController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::all();
        return view('dashboard.maps.index',compact('pesertas'));
    }

}
