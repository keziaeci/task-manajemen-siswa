<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Murid extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function kelas() : BelongsTo {
        return $this->belongsTo(Kelas::class);
    }

    function scopeFilter($query, $filter) {
        // $query->when($filter ?? false , function ($query,$filter) {
        //     return $query->where('kelas.name','like', "%$filter%");
        // });


        $query->when($filter ?? false , function ($query, $filter) {
            return $query->whereHas('kelas', function ($query) use ($filter) {
                $query->where('name', 'like', "%$filter%");
            });
        });
        
    }
}
