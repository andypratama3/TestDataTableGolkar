<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\Http\Requests\Dashboard\KecamatanRequest;

class KecamatanData extends Data{

    public function __construct(
        public readonly string $name,
        public readonly array $desa,
        public readonly ?string $slug,

    ) {
        //
    }
    public static function fromRequest(KecamatanRequest $request): self
    {
        return self::from([
            $request->getName(),
            $request->getDesa(),
            $request->getSlug(),
        ]);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Kolom Nama Kecamatan tidak boleh kosong!',
        ];
    }
}

