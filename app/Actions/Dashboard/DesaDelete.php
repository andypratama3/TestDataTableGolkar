<?php

namespace App\Actions\Dashboard;

use App\Models\Desa;

class DesaDelete {

    public function execute($desa)
    {
        $desa->delete();
    }
}
