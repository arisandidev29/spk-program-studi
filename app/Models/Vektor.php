<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vektor extends Model
{
    protected $table = 'vektor';
    public $fillable = [
        'nilai_s',
        'user_id',
        'alternative_id'
    ];

    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id','id','users');
    }

    public function alternative() :BelongsTo {
        return $this->belongsTo(Alternative::class,'alternative_id','id','alternative');
    }
}

        