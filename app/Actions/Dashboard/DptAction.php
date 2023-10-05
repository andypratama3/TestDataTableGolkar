<?php
namespace App\Actions\Dashboard;

use App\Models\Dpt;
use Illuminate\Support\Str;
use App\DataTransferObjects\DptData;

class DptAction {
    public function execute(DptData $dptData)
    {
        $file = $dptData->file;
        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $uploadPath = 'storage/file/dpt/';
            $fileName = 'Dpt_'.Str::slug($dptData->name).'_'.date('YmdHis').".$ext";
            $file->move($uploadPath, $fileName);
        }

        $dpt = Dpt::updateOrCreate(
            ['slug' => $dptData->slug],
            [
                'name' => $dptData->name,
                'file' => $fileName,
            ]
        );

        return $dpt;
    }
}
