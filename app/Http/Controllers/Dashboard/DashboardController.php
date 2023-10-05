<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Peserta;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Charts\CountSelectColor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(CountSelectColor $chart)
    {
        return view('dashboard.index', ['chart' => $chart->build()]);
    }
}
