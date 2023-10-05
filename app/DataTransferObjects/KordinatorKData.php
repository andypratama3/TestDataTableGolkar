<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\Http\Requests\Dashboard\KordinatorRequest;

class KordinatorKData extends Data{

    public function __construct(
        public readonly string $name,
        public readonly string $lokasi_kecamatan,
        public readonly ?string $slug,

    ) {
        //
    }
    public static function fromRequest(KordinatorRequest $request): self
    {
        return self::from([
            $request->getName(),
            $request->getLokasiKecamatan(),
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

