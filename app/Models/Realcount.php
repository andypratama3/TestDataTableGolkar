<?php

namespace App\Models;

use App\Models\Tps;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Http\Traits\UsesUuid;
use App\Http\Traits\NameHasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Realcount extends Model
{
    use HasFactory;
    use UsesUuid;
    use NameHasSlug;


    protected $table = 'realcounts';

    protected $fillable = [
        'total',
        'slug'
    ];

    public function kecamatan_realcount()
    {
        return $this->belongsToMany(Kecamatan::class, 'real_count_kecamatan');
    }
    public function desa_realcount()
    {
        return $this->belongsToMany(Desa::class, 'real_count_desa');
    }
    public function tps_realcount()
    {
        return $this->belongsToMany(Tps::class, 'real_count_tps');
    }

}
