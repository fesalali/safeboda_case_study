<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventDefinition;
use App\Models\PromoCode;
use App\Models\PromoCodeDefinition;
use App\Utils\ConfigUtil;
use App\Utils\DateUtil;
use Carbon\Carbon;

class PromoCodeRepository
{


    public function getRecords($arr = [])
    {
        $querySet = PromoCode::where($arr);
        return $querySet;
    }

    public function getByCode($code)
    {
        $querySet =
         PromoCode::where(PromoCodeDefinition::CODE, $code)->where(PromoCodeDefinition::IS_ACTIVE, 1)->whereDate(PromoCodeDefinition::EXPIRATION_DATE, " >= ", Carbon::now()->format(DateUtil::DATE_FORMAT_DASHED))->where(PromoCodeDefinition::AVAILABLE_COUNT,"!=",0);
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

    public function active(PromoCode $promoCode)
    {
        $promoCode->is_active = 1;
        return $promoCode;
    }


    public function inActive(PromoCode $promoCode)
    {
        $promoCode->is_active = 0;
        return $promoCode;
    }


    private static function generateCode(): string
    {

        $chars = ConfigUtil::CHARS;
        srand((float)microtime() * 1000000);
        $i = 0;
        $numbers_random = '';

        while ($i <= 5) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $numbers_random = $numbers_random . $tmp;
            $i++;
        }

        if (SELF::checkCode($numbers_random))
            return SELF::generateCode();

        return $numbers_random;
    }

    private static function exists($code)
    {
        return PromoCode::where(PromoCodeDefinition::CODE, $code)->exists();
    }


    private static function checkCode($code): bool
    {
        return SELF::exists($code);
    }

    public function reduceAvailbleCount(PromoCode $promoCode){

        $promoCode->available_count=$promoCode->available_count-1;
        return $promoCode;
    }
}
