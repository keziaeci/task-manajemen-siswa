<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Guru extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    function kelas() : BelongsToMany {
        return $this->belongsToMany(Kelas::class,'kelas_guru');
    }

        function murids() : HasManyThrough {
            return $this->hasManyThrough(Murid::class, KelasGuru::class, 'guru_id', 'kelas_id','id','kelas_id');
        }

    function scopeFilter($query, $filter) {
        $query->when($filter ?? false , function ($query, $filter) {
            return $query->whereHas('kelas', function ($query) use ($filter) {
                $query->where('name', 'like', "%$filter%");
            });
        });
        
    }
}
