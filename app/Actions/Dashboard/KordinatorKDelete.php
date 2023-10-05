<?php

namespace App\Actions\Dashboard;

use App\Models\KordinatorK;


class KordinatorKDelete {

    public function execute($slug)
    {
        $kordinatork = KordinatorK::where('slug', $slug)->firstOrFail();
        $kordinatork->delete();
    }
}
