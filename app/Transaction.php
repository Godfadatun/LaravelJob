<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'amount', 'before', 'after', 'account_nr', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
