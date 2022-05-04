<?php

namespace App\Services;

use App\Models\Event;
use App\Models\PromoCode;
use App\Models\PromoCodeDefinition;
use App\Repositories\PromoCodeRepository;
use Exception;
use PhpParser\ErrorHandler\Collecting;

class PromoCodeService
{


    protected $promoCodeRepository;

    /**
     * EventService constructor.
     * @param PromoCodeRepository $EventRepository Model's Event Repository
     * @throws Exception
     */
    public function __construct(PromoCodeRepository $promoCodeRepository)
    {
        if ($promoCodeRepository == null)
            throw new Exception('Fatal Error, PromoCode Repository Is Required');

        $this->promoCodeRepository = $promoCodeRepository;
    }

    public function all()
    {
        return $this->promoCodeRepository->getRecords()->get();
    }

    public function getByCode($code)
    {
        return  $this->promoCodeRepository->getByCode($code)->first();
    }

    public function getActive()
    {

        return $this->promoCodeRepository->getRecords([
            PromoCodeDefinition::IS_ACTIVE => 1
        ])->get();
    }

    public function getInActive()
    {

        return $this->promoCodeRepository->getRecords([
            PromoCodeDefinition::IS_ACTIVE => 0
        ])->get();
    }

    public function active(PromoCode $promoCode)
    {
        $promoCode = $this->promoCodeRepository->active($promoCode);
        $promoCode->save();
        return $promoCode;
    }


    public function inActive(PromoCode $promoCode)
    {
        $promoCode = $this->promoCodeRepository->inActive($promoCode);
        $promoCode->save();
        return $promoCode;
    }

    public function store($arr)
    {

        $returnValue = PromoCode::create(
            $this->promoCodeRepository->store($arr)
        );

        return $returnValue;
    }


    public function reduceAvailbleCount(PromoCode $promoCode): void
    {
        $promoCode = $this->promoCodeRepository->reduceAvailbleCount($promoCode);
        $promoCode->save();
    }
}
