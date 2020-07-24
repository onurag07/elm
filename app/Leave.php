<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use SoftDeletes;
    protected $table = "leaves";

    protected $fillable = [
        'user_id','leave_type','date_from','date_to','reason','days','is_approved','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
