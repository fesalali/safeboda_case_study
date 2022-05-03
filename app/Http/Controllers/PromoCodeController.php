<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromoCodeRequest;
use App\Models\PromoCode;
use App\Services\PromoCodeService;
use App\Transformers\PromoCodeResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PromoCodeController extends BaseController
{
    //


    /** @var PromoCodeService */

    private $service;

    public function __construct(PromoCodeService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $promoCodes = $this->service->all();
        return $this->ok(PromoCodeResource::collection($promoCodes));
    }


    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getActivePromoCode(): JsonResponse
    {
        $promoCodes = $this->service->getActive();
        return $this->ok(PromoCodeResource::collection($promoCodes));
    }


    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getInActivePromoCode(): JsonResponse
    {
        $promoCodes = $this->service->getInActive();
        return $this->ok(PromoCodeResource::collection($promoCodes));
    }



    /**
     * Store a newly created resource in storage.
     * @param PromoCodeRequest $request
     * @return JsonResponse
     */
    public function store(PromoCodeRequest $request): JsonResponse
    {
        $promoCode = $this->service->store($request->all());
        return $this->ok(new PromoCodeResource($promoCode));
    }



    /**
     *
     * @return JsonResponse
     */
    public function active(PromoCode $promoCode): JsonResponse
    {
        $promoCode = $this->service->active($promoCode);
        return $this->ok(new PromoCodeResource($promoCode));
    }


    /**
     * 
     * @return JsonResponse
     */
    public function inActive(PromoCode $promoCode): JsonResponse
    {
        $promoCode = $this->service->inActive($promoCode);
        return $this->ok(new PromoCodeResource($promoCode));
    }
}
