<?php

namespace App\Services;

use App\Models\PromoCode;
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
        return $this->promoCodeRepository->all()->get();

    }

    public function store($arr)
    {

        $returnValue = PromoCode::create(
            $this->promoCodeRepository->store($arr)
        );

        return $returnValue;

    }
}