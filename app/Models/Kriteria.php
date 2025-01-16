<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    public $fillable = [
        'name',
        'desc',
        'bobot_id',
        'category_id'
    ];
}
