<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //
    protected $fillable = [
        'amount', 'account_nr', 'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
