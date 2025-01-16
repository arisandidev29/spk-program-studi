<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jawaban extends Model
{
    protected $table = 'jawabans';

    public $fillable = [
        'nilai',
        'kriteria_id',
        'user_id',
        'alternative_id',
    ];

    public function kriteria():BelongsTo {
        return $this->belongsTo(Kriteria::class,'kriteria_id','id','kriterias');
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class,'user_id','id','Users');
    }

    public function alternative():BelongsTo {
        return $this->belongsTo(Alternative::class,'alternative_id','id','alternatives');
    }

}
