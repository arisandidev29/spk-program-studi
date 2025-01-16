<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hasil extends Model
{
    protected $table = 'hasils';

    public $fillable = ['user_id','alternative_id','nilai_s','nilai_preferensi'];

    public function user():BelongsTo {
        return $this->belongsTo(User::class,'user_id','id','users');
    }

    public function alternative():BelongsTo {
        return $this->belongsTo(Alternative::class,'alternative_id','id','alternatives');
    }

}
