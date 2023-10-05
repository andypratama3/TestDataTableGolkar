<?php

namespace App\Actions\Dashboard;

use App\Models\Desa;
use App\DataTransferObjects\DesaData;


class DesaAction {
    public function execute(DesaData $DesaData)
    {
        $desa = Desa::updateOrCreate(
            ['slug' => $DesaData->slug],
            [
                'name' => $DesaData->name,
            ],
        );
        if(empty($DesaData->slug)){
            $desa->tps()->attach($DesaData->tps);
        }else{
            $desa->tps()->sync($DesaData->tps);
        }
        return $desa;
    }
}
