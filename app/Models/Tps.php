<?php

namespace App\Models;

use App\Models\Desa;
use App\Models\Peserta;
use App\Http\Traits\UsesUuid;
use App\Http\Traits\NameHasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tps extends Model
{
    use HasFactory;
    use UsesUuid;
    use NameHasSlug;
    use SoftDeletes;

    protected $table = 'tps';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'slug'
    ];

    //data deleted
    protected $dates = ['deleted_at'];

    public function desa()
    {
        return $this->belongsToMany(Desa::class, 'tps_desa');
    }
    public function peserta()
    {
        return $this->belongsToMany(Peserta::class, 'peserta_data');
    }


}
