<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lat', 'lon'];

    public function promoCodes()
    {
        return $this->hasMany(PromoCode::class);
    }


    
}
