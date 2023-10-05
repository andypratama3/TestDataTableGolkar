<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Peserta;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SimpatisanController extends Controller
{
    public function index()
    {
        //loop kecamatan to selected
        $kecamatans = Kecamatan::select(['id','name'])->get();
        return view('dashboard.peserta.simpatisan.index', compact('kecamatans'));
    }
    public function data_table(Request $request)
    {
        $status = 'simpatisan';
        $query = Peserta::where('status', $status)
            ->with('kecamatan_pesertas', 'desa_pesertas', 'tps_pesertas')
            ->orderBy('name', 'asc');

        if ($request->kecamatan) {
            $query = $query->whereHas('kecamatan_pesertas', function ($query) use ($request) {
                $query->where('kecamatan_id', $request->kecamatan);
            });
        }

        if ($request->desa) {
            $query = $query->whereHas('desa_pesertas', function ($query) use ($request) {
                $query->where('desa_id', $request->desa);
            });
        }

        if ($request->tps) {
            $query = $query->whereHas('tps_pesertas', function ($query) use ($request) {
                $query->where('tps_id', $request->tps);
            });
        }

        $pesertas = $query->get();

        $pesertas->each(function ($peserta) {
            $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
        });

        return DataTables::of($pesertas)
            ->addColumn('umur', function ($peserta) {
                return now()->diffInYears($peserta->tgl_lahir);
            })
            ->addColumn('options', function ($row){
                return
                '
                <a href="' . route('dashboard.input.peserta.show', $row->slug) . '" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                <a href="' . route('dashboard.input.peserta.edit', $row->slug) . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                <button data-id="'.$row['slug'].'" class="btn btn-sm btn-danger" id="btn-delete"><bi class="bi-trash"></bi></button>
                ';
            })
            ->rawColumns(['options'])
            ->addIndexColumn()
            ->make(true);
    }


}

