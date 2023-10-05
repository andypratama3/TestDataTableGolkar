<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Desa;
use App\Models\Peserta;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\KordinatorDAction;
use App\Actions\Dashboard\KordinatorDDelete;
use App\DataTransferObjects\KordinatorDData;

class KordinatorDesaController extends Controller
{
    public function index()
    {
        $no = 0;
        // $status = 'kordinator_desa';
        // $pesertas = Peserta::where('status',$status)->orderBy('name')->get();
        // $pesertas->transform(function ($peserta) {
            //     $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
            //     return $peserta;
            // });
            //loop kecamatan di table
        $kecamatans = Kecamatan::select(['id','name','slug'])->get();
        return view('dashboard.kordinatord.index', compact('no','kecamatans'));
    }
    public function kordinator_desa($name)
{
    $kecamatans = Kecamatan::where('name', $name)->get();
    $no = 0;
    $status = 'kordinator_desa';

    $pesertas = Peserta::where('status', $status)
        ->orderBy('name')
        ->get()
        ->filter(function ($peserta) use ($name) {
            return $peserta->kecamatan_pesertas->contains('name', $name);
        })
        ->sortBy(function ($peserta) use ($name) {
            return $peserta->kecamatan_pesertas->first(function ($kecamatan) use ($name) {
                return $kecamatan->name === $name;
            })->name;
        });

    $pesertas->transform(function ($peserta) {
        $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
        return $peserta;
    });

    return view('dashboard.kordinatord.kordinator', compact('no', 'name', 'pesertas'));
}


}

