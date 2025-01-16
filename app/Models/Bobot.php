<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bobot extends Model
{
    protected $table = 'bobots';

    public $fillable = ['nilai','normalisasi'];

    public function kriteria():HasMany {
        return $this->hasMany(Kriteria::class,'bobot_id','id');
    }
}
