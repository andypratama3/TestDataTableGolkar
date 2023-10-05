<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tps;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Realcount;
use Illuminate\Http\Request;
use App\Charts\RealCountChart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\RealCountAction;
use App\DataTransferObjects\RealCountData;

class RealCountController extends Controller
{
    public function index(RealCountChart $chart)
    {
        $kecamatans = Kecamatan::all();
        return view('dashboard.realcount.index',['chart' => $chart->build()], compact('kecamatans'));
    }
    public function create()
    {
        $kecamatans = Kecamatan::select(['id','name','slug'])->get();
        return view('dashboard.realcount.create', compact('kecamatans'));
    }
    // public function store(RealCountAction $realcountAction, RealCountData $realCount_data)
    public function store(RealCountAction $realcountAction, RealCountData $realCountData)
    {
        $realcountAction->execute($realCountData);
        return redirect()->route('dashboard.realcount.index')->with('success', 'Berhasil Menambahkan Realcount');
    }
    public function edit($id)
    {
        $kecamatans = Kecamatan::select(['id','name','slug'])->get();
        $realcount = Realcount::where('id', $id)->firstOrfail();
        return view('dashboard.realcount.edit',compact('realcount','kecamatans'));
    }
    public function update(RealCountAction $realcountAction, RealCountData $realCountData, $id)
    {
        $realcountAction->execute($realCountData, $id);
        return redirect()->route('dashboard.realcount.index')->with('success', 'Berhasil Update Realcount');
    }
    public function destroy($id)
    {
        $realcount = Realcount::where('id', $id)->firstOrfail();
        $realcount->delete();
        return redirect()->route('dashboard.realcount.index')->with('success', 'Berhasil Hapus Realcount');

    }
    public function tableRealcount()
    {
        $no = 0;
        $kecamatans = Kecamatan::select(['id','name','slug'])->get();
        return view('dashboard.realcount.tabel', compact('kecamatans','no'));

    }
    public function kecamatanRealcount($name)
    {
        $kecamatans = Kecamatan::where('name', $name)->select('id','name','slug')->orderBy('name')->get();
        return view('dashboard.realcount.desa', compact('kecamatans'));
    }
    public function desaRealcount($name)
    {
        $no = 0;

        $realcounts = Realcount::all();

        return view('dashboard.realcount.tps', compact('realcounts', 'no'));
    }
    public function getTpsDesaCount(Request $request)
    {
        $desa_id = $request->id_desa;

        // Cari desa berdasarkan $desa_id
        $desa = Desa::find($desa_id);

        // Inisialisasi array untuk menyimpan status keberadaan TPS
        $tpsExists = [];

        if ($desa) {
            // Ambil data TPS yang ada di desa
            foreach ($desa->tps as $tps) {
                // Periksa apakah TPS tersebut sudah ada dalam tabel Realcount
                $exists = Realcount::whereHas('desa_realcount', function ($query) use ($desa_id) {
                    $query->where('desa_id', $desa_id);
                })
                ->whereHas('tps_realcount', function ($query) use ($tps) {
                    $query->where('tps_id', $tps->id);
                })
                ->exists();

                // Simpan status keberadaan TPS ke dalam array
                $tpsExists[$tps->id] = $exists;
            }
        }

        // Dapatkan daftar TPS yang belum ada dalam Realcount dan nilainya false
        $missingTps = array_filter($tpsExists, function ($value) {
            return !$value;
        });

        // Ambil data TPS yang belum ada dalam Realcount
        $missingTpsData = Tps::whereIn('id', array_keys($missingTps))->get();

        // Format data TPS yang belum ada menjadi array
        $options = "<option>Pilih Tps</option>";
        foreach ($missingTpsData as $tps) {
            $options.= "<option value='$tps->id'>$tps->name</option>";
        }
    return response()->json(['options' => $options, 'tpsExists' => $tpsExists]);
    }

    // public function getTpsDesaCount(Request $request)
    // {
    //     $desa_id = $request->id_desa;

    //     // Cari desa berdasarkan $desa_id
    //     $desa = Desa::find($desa_id);

    //     // Inisialisasi array untuk menyimpan status keberadaan TPS
    //     $tpsExists = [];

    //     if ($desa) {
    //         // Ambil data TPS yang ada di desa
    //         foreach ($desa->tps as $tps) {
    //             // Periksa apakah TPS tersebut sudah ada dalam tabel Realcount
    //             $exists = Realcount::whereHas('desa_realcount', function ($query) use ($desa_id) {
    //                 $query->where('desa_id', $desa_id);
    //             })
    //             ->whereHas('tps_realcount', function ($query) use ($tps) {
    //                 $query->where('tps_id', $tps->id);
    //             })
    //             ->exists();

    //             // Simpan status keberadaan TPS ke dalam array
    //             $tpsExists[$tps->id] = $exists;
    //         }
    //     }

    //     // Dapatkan daftar TPS yang belum ada dalam Realcount
    //     $desaTps = $desa->tps->pluck('id')->toArray();
    //     $missingTps = array_diff($desaTps, array_keys($tpsExists));

    //     // Ambil data TPS yang belum ada dalam Realcount
    //     $missingTpsData = Tps::whereIn('id', $missingTps)->get();

    //     // Format data TPS yang belum ada menjadi array
    //     $options = [];
    //     foreach ($missingTpsData as $tps) {
    //         $options[] = [
    //             'id' => $tps->id,
    //             'name' => $tps->name,
    //         ];
    //     }
    //     return response()->json(['options' => $options, 'tpsExists' => $tpsExists]);
    // }

        // $desa_id = $request->desa_id;
        // $desas = Desa::where('id', $desa_id)->orderBy('name')->get();

        // $tps_id = $request->input('tps_id');
        // $option = "<option>Pilih Tps</option>";

        // // Cek apakah desa_id dan tps_id telah ada dalam tabel Realcount
        // $realcountExists = Realcount::whereHas('desa_realcount', function ($query) use ($desa_id) {
        //     $query->where('desa_id', $desa_id);
        // })
        // ->whereHas('tps_realcount', function ($query) use ($tps_id) {
        //     $query->where('tps_id', $tps_id);
        // })
        // ->exists();

        // if ($realcountExists) {
        //     // TPS sudah ada dalam tabel Realcount, tidak perlu menambahkannya
        //     return response()->json(['options' => []]);
        // } else {
        //     $id_desa = $request->id_desa;
        //     $desas = Desa::where('id', $id_desa)->orderBy('name')->get();

        //     foreach ($desas as $key => $desa) {
        //         foreach ($desa->tps as $tps) {
        //             $option .= "<option value='$tps->id'>$tps->name</option>";
        //         }
        //     }
        //     // Mengembalikan respons JSON dengan opsi TPS yang tersedia
        //     return response()->json(['options' => $option]);
        // }



    // public function getTpsDesaCount(Request $request )
    // {
    //     $desa_id = $request->input('desa_id');
    //     $tps_id = $request->input('tps_id');
    //     $pesertas = Realcount::whereHas('desa_realcount', $desa_id)
    //     ->whereHas('tps_realcount', function ($query) use ($tps_id) {
    //         $query->where('tps_id', $tps_id);
    //     })
    //     ->get();
    // }
}
