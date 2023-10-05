<?php

namespace App\Actions\Dashboard;

use App\Models\Kecamatan;

class KecamatanDelete {

    public function execute($kecamatan)
    {
        $kecamatan->delete();
    }
}
