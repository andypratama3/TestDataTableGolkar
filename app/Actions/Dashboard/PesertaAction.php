<?php
namespace App\Actions\Dashboard;

use App\Models\Peserta;
use App\DataTransferObjects\PesertaData;

class PesertaAction
{
    public function execute(PesertaData $pesertaData)
    {
        $peserta = Peserta::updateOrCreate(
            ['slug' => $pesertaData->slug],
            [
                'name' => $pesertaData->name,
                'nik' => $pesertaData->nik,
                'tgl_lahir' => $pesertaData->tgl_lahir,
                'hp' => $pesertaData->hp,
                'alamat' => $pesertaData->alamat,
                'warna' => $pesertaData->warna,
                'status' => $pesertaData->status,
                'perekrut' => $pesertaData->perekrut,
                // 'latitude' => $pesertaData->latitude,
                // 'longitude' => $pesertaData->longitude,
            ]
        );

        if (empty($pesertaData->slug)) {
            $peserta->kecamatan_pesertas()->attach($pesertaData->kecamatan);
            $peserta->desa_pesertas()->attach($pesertaData->desa);
            $peserta->tps_pesertas()->attach($pesertaData->tps);
        } else {
            $peserta->kecamatan_pesertas()->sync($pesertaData->kecamatan);
            $peserta->desa_pesertas()->sync($pesertaData->desa);
            $peserta->tps_pesertas()->sync($pesertaData->tps);
        }

        return $peserta;
    }
}

