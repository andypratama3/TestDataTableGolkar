<?php

namespace App\Actions\Dashboard;

use App\Models\Dpt;
use App\DataTransferObjects\DesaData;


class DeleteDptAction
{
    public function execute($slug)
    {
        $dpt = Dpt::where('slug', $slug)->firstOrFail();
        $dpt->delete();
    }
}
