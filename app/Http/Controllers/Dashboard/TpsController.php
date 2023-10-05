<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tps;
use Illuminate\Http\Request;
use App\Actions\Dashboard\TpsAction;
use App\DataTransferObjects\TpsData;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\TpsActionDelete;

class TpsController extends Controller
{
    public function index()
    {
        $no = 0;
        $tpss = Tps::select(['id','name','slug'])->orderBy('name')->get();
        // $no = $limit * ($tpss->currentPage() - 1);
        return view('dashboard.data.tps.index', compact(
            'tpss',
            'no'
        ));
    }
    public function create()
    {
        return view('dashboard.data.tps.create');
    }
    public function store(TpsData $TpsData, TpsAction $TpsAction)
    {
        $TpsAction->execute($TpsData);
        return redirect()->route('dashboard.datamaster.tps.index')->with('success','Berhasil Menambah Tps');
    }
    public function edit(Tps $tps)
    {
        return view('dashboard.data.tps.edit',compact('tps'));
    }
    public function destroy(TpsActionDelete $TpsActionDelete, Tps $tps)
    {
        $TpsActionDelete->execute($tps);
        return redirect()->route('dashboard.datamaster.tps.index')->with('success','Berhasil Hapus Tps');

    }
}

