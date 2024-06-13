<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function gurus() : BelongsToMany {
        return $this->belongsToMany(Guru::class,'kelas_guru');
    }

    function murids() : HasMany {
        return $this->hasMany(Murid::class);
    }
}
