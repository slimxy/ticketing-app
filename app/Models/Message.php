<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    public function ticket(){
        return
        $this->belongsTo(Ticket::class);
    }
    public function sender(){
        return
        $this->belongsTo(User::class, 'sender_id');
    }

}
