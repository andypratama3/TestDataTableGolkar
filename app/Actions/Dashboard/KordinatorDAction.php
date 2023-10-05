<?php

namespace App\Actions\Dashboard;

use App\Models\KordinatorD;
use App\DataTransferObjects\KordinatorDData;


class KordinatorDAction {
    public function execute(KordinatorDData $KordinatorDData)
    {
        $kordinatorD = KordinatorD::updateOrCreate(
            ['slug' => $KordinatorDData->slug],
            [
                'name' => $KordinatorDData->name,
                'lokasi_desa' => $KordinatorDData->lokasi_desa,
            ],
        );

        return $kordinatorD;
    }
}
