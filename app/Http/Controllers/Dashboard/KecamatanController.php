<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\KecamatanAction;
use App\Actions\Dashboard\KecamatanDelete;
use App\DataTransferObjects\KecamatanData;

class KecamatanController extends Controller
{
    public function index()
    {

        $no = 0;
        $kecamatans = Kecamatan::select(['name', 'slug'])->orderBy('name')->get();

        return view('dashboard.data.kecamatan.index', compact(
            'kecamatans',
            'no'
        ));
    }
    public function create()
    {
        $desas = Desa::select(['id','name','slug'])->orderBy('name')->get();
        return view('dashboard.data.kecamatan.create',compact('desas'));
    }
    public function store(KecamatanData $kecamatanData, KecamatanAction $kecamatanAciton)
    {
        $kecamatanAciton->execute($kecamatanData);
        return redirect()->route('dashboard.datamaster.kecamatan.index')->with('success','Berhasil Menambah Kecamatan');
    }
    public function edit(Kecamatan $kecamatan)
    {
        $desas = Desa::select(['id','name','slug'])->orderBy('name')->get();
        return view('dashboard.data.kecamatan.edit', compact('kecamatan','desas'));
    }
    public function update(KecamatanData $kecamatanData, KecamatanAction $kecamatanAciton)
    {
        $kecamatanAciton->execute($kecamatanData);
        return redirect()->route('dashboard.datamaster.kecamatan.index')->with('success','Berhasil Edit Kecamatan');
    }
    public function destroy(KecamatanDelete $kecamatanDelete, Kecamatan $kecamatan)
    {
        $kecamatanDelete->execute($kecamatan);
        return redirect()->route('dashboard.datamaster.kecamatan.index')->with('success','Berhasil Hapus Kecamatan');

    }


}
