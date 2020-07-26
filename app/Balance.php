<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //
    protected $fillable = [
        'amount', 'account_nr', 'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
