<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    public $fillable = [
        'name',
        'desc',
        'bobot_id',
        'kategori'
    ];

    public function bobot():BelongsTo {
        return $this->belongsTo(Bobot::class,'bobot_id','id','bobots');
    }

    public function Jawaban(): HasMany {
        return $this->hasMany(Jawaban::class,'kriteria_id','id');
    }

    
}
 