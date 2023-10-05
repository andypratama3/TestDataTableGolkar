<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Dpt;
use Illuminate\Http\Request;
use App\Actions\Dashboard\DptAction;
use App\DataTransferObjects\DptData;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\DeleteDptAction;

class DptController extends Controller
{
    public function index()
    {
        $no = 0;
        $dpts = Dpt::select(['name','file','slug'])->get();
        return view('dashboard.dpt.index', compact('dpts','no'));
    }
    public function  create()
    {
        return view('dashboard.dpt.create');
    }
    public function store(DptData $dptData, DptAction $dptAction)
    {
        $dptAction->execute($dptData);
        return redirect()->route('dashboard.dpt.index')->with('success','Berhasil Menambah Dpt');
    }
    public function destroy(DeleteDptAction $deleteActionDpt,$slug)
    {
        $deleteActionDpt->execute($slug);
        return redirect()->route('dashboard.dpt.index')->with('success','Berhasil Menghapus Dpt');
    }

}
