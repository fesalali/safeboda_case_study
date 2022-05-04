<?php

namespace App\Models;

use App\Utils\ConfigUtil;
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


    public function checkRadius($lat1, $lon1)
    {

        $lat2 = $this->lat;
        $lon2 = $this->lon;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper(ConfigUtil::UNIT);
        $distance = 0;
        if ($unit == "K") {
            $distance = ($miles * 1.609344);
        } else if ($unit == "N") {
            $distance = ($miles * 0.8684);
        } else {
            $distance = $miles;
        }


        return ConfigUtil::REDIUS >= $distance;
    }
}
