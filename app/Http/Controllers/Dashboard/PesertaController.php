<?php

namespace App\Http\Controllers\Dashboard;

use PDF;
use DateTime;
use App\Models\Tps;
use App\Models\Desa;
use App\Models\Peserta;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Exports\PesertaExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Actions\Dashboard\PesertaAction;
use App\DataTransferObjects\PesertaData;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Actions\Dashboard\PesertaActionStore;
use App\Actions\Dashboard\DeletePesertaAction;
use App\Http\Requests\Dashboard\PesertaRequest;

class PesertaController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::select(['id','name','slug'])->get();
        return view('dashboard.peserta.relawan.index', compact('kecamatans'));
    }

    public function data_table(Request $request)
    {
        $status = 'relawan';
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

    public function getAgeAttribute()
    {
        return now()->diffInYears($this->tanggal_lahir);
    }
    ///nik tidak boleh sama
    public function create(Kecamatan $kecamatan)
    {
        $kecamatans = Kecamatan::select(['id','name','slug'])->get();
        return view('dashboard.peserta.create', compact('kecamatans'));
    }
    public function getnik(Request $request)
    {
        $input_nik = $request->input_nik;
        $pesertas = Peserta::where('nik', $input_nik)->first();
        if(!$pesertas)
        {
            return ['bisa' => 'Nomor NIK Bisa Digunakan.'];
        }else{
            return ['tidak' => 'Nomor NIK Telah Terdaftar.'];
        }
    }

    public function store(PesertaData $pesertaData, PesertaAction $PesertaAction)
    {
        $existingPesertaWithSameNik = Peserta::where('nik', $pesertaData->nik)->first();
        if ($existingPesertaWithSameNik && $existingPesertaWithSameNik->id != $pesertaData->id) {
            // NIK sudah digunakan oleh peserta lain
            return Redirect::route('dashboard.input.peserta.create', $pesertaData->slug)->with('error', 'Nik Telah Digunakan');
        }else{
            $PesertaAction->execute($pesertaData);
            if($pesertaData->status == 'relawan'){
                return redirect()->route('dashboard.input.peserta.index')->with('success','Berhasil Menambahkan Peserta Relawan');
            }else if($pesertaData->status == 'simpatisan'){
                return redirect()->route('dashboard.input.simpatisan.index')->with('success','Berhasil Menambahkan Peserta Simpatisan');
            }else if($pesertaData->status == 'kordinator_kecamatan'){
                return redirect()->route('dashboard.input.kordinator.kecamatan.index')->with('success','Berhasil Menambahkan Peserta & Kordinator Kecamatan');
            }else if($pesertaData->status == 'kordinator_desa'){
                return redirect()->route('dashboard.input.kordinator.desa.index')->with('success','Berhasil Menambahkan Peserta & Kordinator Desa');
            }else{
                return response('Gagal Menambahkan Data', 403);
            }
        }

    }
    public function show($slug)
    {
        $peserta = Peserta::where('slug', $slug)->firstOrFail();
        return view('dashboard.peserta.show', compact('peserta'));
    }

    public function edit($slug)
    {
        $kecamatans = Kecamatan::select(['id','name','slug'])->orderBy('name')->get();
        $peserta = Peserta::where('slug', $slug)->orderBy('name')->firstOrFail();
        return view('dashboard.peserta.edit', compact('kecamatans','peserta'));
    }
    public function update(PesertaData $pesertaData, PesertaAction $pesertaAction,$slug)
    {
        $pesertaAction->execute($pesertaData,$slug);
            if($pesertaData->status == 'relawan'){
                return redirect()->route('dashboard.input.peserta.index')->with('success','Berhasil Update Peserta Relawan');
            }else if($pesertaData->status == 'simpatisan'){
                return redirect()->route('dashboard.input.simpatisan.index')->with('success','Berhasil Update Peserta Simpatisan');
            }else if($pesertaData->status == 'kordinator_kecamatan'){
                return redirect()->route('dashboard.input.kordinator.kecamatan.index')->with('success','Berhasil Update Peserta & Kordinator Kecamatan');
            }else if($pesertaData->status == 'kordinator_desa'){
                return redirect()->route('dashboard.input.kordinator.desa.index')->with('success','Berhasil Update Peserta & Kordinator Desa');
            }else{
                return response('Gagal Update Data', 403);
            }
    }
    public function destroy(Request $request)
    {
        $slug = $request->slug;
        $peserta = Peserta::where('slug', $slug)->firstOrFail();
        if ($peserta) {
            $peserta->delete();
            return response()->json(['status' => 'success', 'message' => 'Berhasil Menghapus Peserta']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal Menghapus Peserta']);
        }
    }

    //get data drop down
    public function getdesa(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        $kecamatans = Kecamatan::where('id',$id_kecamatan)->select(['id','name','slug'])->get();

        $option = "<option value=''>Pilih Desa</option>";
        foreach ($kecamatans as $kecamatan) {
            foreach ($kecamatan->desa as $desa) {
                $option.= "<option value='$desa->id'>$desa->name</option>";
           }
        }
        echo $option;
    }
    public function gettps(Request $request)
    {
        $id_desa = $request->id_desa;
        $desas = Desa::where('id', $id_desa)->orderBy('name')->get();
        $option = "<option value=''>Pilih Tps</option>";
        foreach ($desas as $key => $desa) {
            foreach ($desa->tps as $tps) {
                    $option.= "<option value='$tps->id'>$tps->name</option>";
                }
            }
        echo $option;
    }
    //export excel
    public function export_excel()
    {
        return Excel::download(new PesertaExport, 'pesertas.xlsx');
    }

    //generate pdf
    public function generate_pdf()
    {
        $pesertas = Peserta::all();
        $pesertas->transform(function ($peserta) {
            $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
            return $peserta;
        });
        $data = [
            'pesertas' => $pesertas
        ];

        $pdf = PDF::loadView('dashboard.peserta.generatePdf', $data);

        return $pdf->download('peserta.pdf');
    }
    public function getPesertaRelawan(Request $request)
    {
        $status = 'relawan';
        $id_kecamatan = $request->input('id_kecamatan');
        $pesertas = Peserta::where('status',$status)->whereHas('kecamatan_pesertas', function ($query) use ($id_kecamatan) {
            $query->where('kecamatan_id', $id_kecamatan);
        })->get();
        $pesertas->transform(function ($peserta) {
            $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
            return $peserta;
        });
        $kecamatans = Kecamatan::select(['id','name'])->get();
        return response()->json(['pesertas' => $pesertas]);
    }

    public function getPesertaRelawanDesa(Request $request)
    {
        $status = 'relawan';
        $id_desa = $request->input('id_desa');
        $pesertas = Peserta::where('status',$status)->whereHas('desa_pesertas', function ($query) use ($id_desa) {
            $query->where('desa_id', $id_desa);
        })->get();
        $pesertas->transform(function ($peserta) {
            $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
            return $peserta;
        });
        return response()->json(['pesertas' => $pesertas]);
    }
    public function getPesertaRelawanTps(Request $request)
    {
        $status = 'relawan';
        $desa_id = $request->input('desa_id');
        $tps_id = $request->input('tps_id');

        $pesertas = Peserta::where('status', $status)
        ->whereHas('desa_pesertas', function ($query) use ($desa_id) {
            $query->where('desa_id', $desa_id);
        })
        ->whereHas('tps_pesertas', function ($query) use ($tps_id) {
            $query->where('tps_id', $tps_id);
        })
        ->get();
        $pesertas->transform(function ($peserta) {
            $peserta->umur = now()->diffInYears($peserta->tgl_lahir);
            return $peserta;
        });
        return response()->json(['pesertas' => $pesertas]);
    }

}
