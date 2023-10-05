<?php

namespace App\Models;

use App\Models\Tps;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Http\Traits\UsesUuid;
use App\Http\Traits\NameHasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peserta extends Model
{
    use HasFactory;
    use UsesUuid;
    use NameHasSlug;
    use SoftDeletes;


    protected $table = 'pesertas';

    protected $fillable = [
        'name',
        'nik',
        'hp',
        'alamat',
        'tgl_lahir',
        'warna',
        'perekrut',
        'status',
    ];

    protected $dates = ['deleted_at'];


    public function kecamatan_pesertas()
    {
        return $this->belongsToMany(Kecamatan::class, 'peserta_kecamatan');
    }

    public function desa_pesertas()
    {
        return $this->belongsToMany(Desa::class, 'peserta_desa');
    }

    public function tps_pesertas()
    {
        return $this->belongsToMany(Tps::class, 'peserta_tps');
    }







}
