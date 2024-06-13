<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guru extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    function kelas() : BelongsToMany {
        return $this->belongsToMany(Kelas::class,'kelas_guru');
    }
}
