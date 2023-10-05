<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\Http\Requests\Dashboard\KordinatorDRequest;

class KordinatorDData extends Data{

    public function __construct(
        public readonly string $name,
        public readonly string $lokasi_desa,
        public readonly ?string $slug,

    ) {
        //
    }
    public static function fromRequest(KordinatorDRequest $request): self
    {
        return self::from([
            $request->getName(),
            $request->getLokasiDesa(),
            $request->getSlug(),
        ]);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Kolom Nama Kecamatan tidak boleh kosong!',
            'lokasi.required' => 'Kolom Lokasi Kecamatan tidak boleh kosong!',
        ];
    }
}

