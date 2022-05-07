<?php


namespace App\Traits;

use App\Utils\ConfigUtil;

trait PromoCodeTrait
{

    public function checkRadius($lat1, $lon1,$lat2 ,$lon2)
    {

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