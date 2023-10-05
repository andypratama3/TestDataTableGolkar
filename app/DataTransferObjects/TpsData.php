<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\Http\Requests\Dashboard\TpsRequest;

class TpsData extends Data{

    public function __construct(
        public readonly string $name,
        public readonly ?string $slug,

    ) {
        //
    }
    public static function fromRequest(TpsRequest $request): self
    {
        return self::from([
            $request->getName(),
            $request->getSlug(),
        ]);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Kolom Nama Desa tidak boleh kosong!',
        ];
    }
}

