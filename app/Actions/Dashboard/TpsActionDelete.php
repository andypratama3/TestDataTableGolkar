<?php

namespace App\Actions\Dashboard;

use App\Models\Tps;

class TpsActionDelete {

    public function execute($tps)
    {
        $tps->delete();
        
    }
}
