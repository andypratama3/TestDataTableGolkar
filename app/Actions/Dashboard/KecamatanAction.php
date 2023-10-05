<?php

namespace App\Actions\Dashboard;

use App\Models\Kecamatan;
use App\DataTransferObjects\KecamatanData;


class KecamatanAction {
    public function execute(KecamatanData $kecamatanData)
    {
        $kecamatan = Kecamatan::updateOrCreate(
            ['slug' => $kecamatanData->slug],
            [
                'name' => $kecamatanData->name,
            ],
        );

        if(empty($kecamatanData->slug)){
            $kecamatan->desa()->attach($kecamatanData->desa);
        }else{
            $kecamatan->desa()->sync($kecamatanData->desa);
        }


        return $kecamatan;
    }
}
