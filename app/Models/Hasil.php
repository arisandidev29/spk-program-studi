<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasils';

    public $fillable = ['user_id','alternative_id','nilai_s','nilai_preferensi'];
}
