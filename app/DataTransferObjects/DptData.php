<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Dashboard\DptRequest;

class DptData extends Data{

    public function __construct(
        public readonly string $name,
        public readonly UploadedFile $file,
        public readonly ?string $slug,

    ) {
        //
    }
    public static function fromRequest(DptRequest $request): self
    {
        return self::from([
            $request->getName(),
            $request->getFile(),
            $request->getSlug(),
        ]);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Kolom Nama tidak boleh kosong!',
            'file.required' => 'Kolom file tidak boleh kosong!',
        ];
    }
}

