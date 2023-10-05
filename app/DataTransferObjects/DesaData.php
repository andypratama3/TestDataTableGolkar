<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\Http\Requests\Dashboard\DesaRequest;

class DesaData extends Data{

    public function __construct(
        public readonly string $name,
        public readonly array $tps,
        public readonly ?string $slug,

    ) {
        //
    }
    public static function fromRequest(DesaRequest $request): self
    {
        return self::from([
            $request->getName(),
            $request->getTps(),
            $request->getSlug(),
        ]);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Kolom Nama Desa tidak boleh kosong!',
            'tps.required' => 'Tps Desa tidak boleh kosong!',
        ];
    }
}

