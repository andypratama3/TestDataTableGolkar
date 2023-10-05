<?php

namespace App\Models;

use App\Models\Tps;
use App\Models\Desa;
use App\Models\Peserta;
use App\Models\Kecamatan;
use Illuminate\Support\Str;
use App\Http\Traits\UsesUuid;
use App\Http\Traits\NameHasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;
    use UsesUuid;
    use NameHasSlug;
    use SoftDeletes;

    protected $table = 'desas';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'slug'
    ];

    //data deleted
    protected $dates = ['deleted_at'];

    public function tps()
    {
        return $this->belongsToMany(Tps::class, 'tps_desa');
    }
    public function kecamatan()
    {
        return $this->belongsToMany(Kecamatan::class, 'kecamatan_desa');
    }

    public function peserta()
    {
        return $this->belongsToMany(Peserta::class, 'peserta_data');
    }



}
