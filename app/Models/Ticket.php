<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //

    public function organisation(){
        return
        $this->belongsTo(User::class,'organisation_id');
    }

    public function customer(){
        return
        $this->belongsTo(User::class,'customer_id');
    }

    public function messages(){
        return
        $this->hasMany(Message::class);
    }

}
