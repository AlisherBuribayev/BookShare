<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $guarded = [];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subs()
    {
        return $this->belongsTo(Subscription::class);
    }
}