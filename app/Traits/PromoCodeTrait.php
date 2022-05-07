<?php


namespace App\Traits;

use App\Utils\ConfigUtil;
use Ixudra\Curl\Facades\Curl;

trait PromoCodeTrait
{

    public function checkRadius($lat1, $lon1, $lat2, $lon2)
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

    public function getPolyLines($lat1, $lon1, $lat2, $lon2)
    {


        $params = "origin=" . $lat1 . "," . $lon1 . "&destination=" . $lat2 . "," . $lon2 . "&key=" . ConfigUtil::GOOGOLE_KEY;
        $url = 'https://maps.googleapis.com/maps/api/directions/json?' . $params;



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return null;
        }

        $response = json_decode($response);
        if (isset($response->status) && $response->status == "OK") {
            return $response->routes[0]->overview_polyline;
        } else {
            return null;
        }
    }
}
