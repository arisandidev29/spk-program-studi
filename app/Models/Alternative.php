<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternative extends Model
{
    protected $table = 'alternatives';
    public $fillable = ['name','desc'];

    public function jawaban():HasMany {
        return $this->hasMany(Jawaban::class,'alternative_id','id');
    }

    public function hasil():HasMany {
        return $this->hasMany(Hasil::class,'alternative_id','id');
    }
}
