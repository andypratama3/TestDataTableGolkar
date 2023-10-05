<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use App\Http\Traits\NameHasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KordinatorK extends Model
{
    use HasFactory;
    use UsesUuid;
    use NameHasSlug;

    protected $table = 'kordinator_k_s';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'lokasi_kecamatan',
        'slug',
    ];
    


}
