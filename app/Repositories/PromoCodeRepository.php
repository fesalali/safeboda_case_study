<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventDefinition;
use App\Models\PromoCode;
use App\Models\PromoCodeDefinition;

class PromoCodeRepository
{


    public function all()
    {
        $querySet = PromoCode::query();
        return $querySet;
    }

  

    public function store($arr): array
    {


        return [
            PromoCodeDefinition::EVENT_ID => $arr[PromoCodeDefinition::EVENT_ID],
            PromoCodeDefinition::EXPIRATION_DATE => $arr[PromoCodeDefinition::EXPIRATION_DATE],
            PromoCodeDefinition::IS_ACTIVE => 1,
            PromoCodeDefinition::AVAILABLE_COUNT => $arr[PromoCodeDefinition::AVAILABLE_COUNT],
            PromoCodeDefinition::CODE => SELF::generateCode(),

        ];
    }


    private static function generateCode() : string { 

        $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $numbers_random = '' ; 
    
        while ($i <= 5) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $numbers_random = $numbers_random . $tmp; 
            $i++; 
        } 
    
        if(SELF::checkCode($numbers_random))
            return SELF::generateCode();

        return $numbers_random; 
    
    } 

    private static function exists($code)
    {
        return PromoCode::where('code', $code)->exists();
    }


    private static function checkCode($code) : bool{

        return SELF::exists($code);

    }
    
}
