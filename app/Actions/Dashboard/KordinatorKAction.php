<?php

namespace App\Actions\Dashboard;

use App\Models\KordinatorK;
use App\DataTransferObjects\KordinatorKData;


class KordinatorKAction {
    public function execute(KordinatorKData $KordinatorKData)
    {
        $kordinatorK = KordinatorK::updateOrCreate(
            ['slug' => $KordinatorKData->slug],
            [
                'name' => $KordinatorKData->name,
                'lokasi_kecamatan' => $KordinatorKData->lokasi_kecamatan,
            ],
        );
        return $kordinatorK;
    }
}
