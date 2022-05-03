<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['event_id','code','is_active','available_count','expiration_date'];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
