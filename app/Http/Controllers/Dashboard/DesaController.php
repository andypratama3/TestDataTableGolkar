<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tps;
use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\DesaAction;
use App\Actions\Dashboard\DesaDelete;
use App\DataTransferObjects\DesaData;

class DesaController extends Controller
{
    public function index()
    {
        $no = 0;
        $desas = Desa::select(['name','slug'])->orderBy('name')->get();
        return view('dashboard.data.desa.index',compact(
            'desas',
            'no',
        ));
    }
    public function create()
    {
        $tpss = Tps::select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.data.desa.create', compact('tpss'));
    }
    public function store(DesaData $desaData, DesaAction $desaAction)
    {
        $desaAction->execute($desaData);
        return redirect()->route('dashboard.datamaster.desa.index')->with('success','Berhasil Menambah Desa');
    }

    public function show(Desa $desa)
    {
        $tpss = Tps::select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.data.desa.show', compact('desa','tpss'));
    }

    public function edit(Desa $desa)
    {
        $tpss = Tps::select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.data.desa.edit', compact('desa','tpss'));
    }
    public function update(DesaData $desaData, DesaAction $desaAction)
    {
        $desaAction->execute($desaData);
        return redirect()->route('dashboard.datamaster.desa.index')->with('success','Berhasil Edit Desa');
    }
    public function destroy(DesaDelete $desaDelete, Desa $desa)
    {
        $desaDelete->execute($desa);
        // dd($desa);
        return redirect()->route('dashboard.datamaster.desa.index')->with('success','Berhasil Hapus Desa');

    }
}
