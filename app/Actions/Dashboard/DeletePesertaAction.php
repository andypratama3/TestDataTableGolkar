<?php

namespace App\Actions\Dashboard;

use App\Models\Peserta;


class DeletePesertaAction {

    public function execute($slug)
    {
        $peserta = Peserta::where('slug', $slug)->firstOrFail();
        $peserta->delete();
    }
}
