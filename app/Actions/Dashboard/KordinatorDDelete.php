<?php

namespace App\Actions\Dashboard;

use App\Models\KordinatorD;


class KordinatorDDelete {

    public function execute($slug)
    {
        $kordinatorD = KordinatorD::where('slug', $slug)->firstOrFail();
        $kordinatorD->delete();
    }
}
