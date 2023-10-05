<?php

namespace App\Actions\Dashboard;

use App\Models\Tps;
use App\DataTransferObjects\TpsData;


class TpsAction {
    public function execute(TpsData $TpsData)
    {
        $tps = Tps::updateOrCreate(
            ['slug' => $TpsData->slug],
            [
                'name' => $TpsData->name,
            ],
        );

        return $tps;
    }
}
