<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromoCodeRequest;
use App\Http\Requests\PromoCodeValidatRequest;
use App\Models\PromoCode;
use App\Services\PromoCodeService;
use App\Traits\PromoCodeTrait;
use App\Transformers\PromoCodeResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PromoCodeController extends BaseController
{
    //

    use PromoCodeTrait;

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
        try {
            $promoCodes = $this->service->all();
            return $this->ok(PromoCodeResource::collection($promoCodes));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }


    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getActivePromoCode(): JsonResponse
    {
        try {
            $promoCodes = $this->service->getActive();
            return $this->ok(PromoCodeResource::collection($promoCodes));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }


    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getInActivePromoCode(): JsonResponse
    {

        try {
            $promoCodes = $this->service->getInActive();
            return $this->ok(PromoCodeResource::collection($promoCodes));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }



    /**
     * Store a newly created resource in storage.
     * @param PromoCodeRequest $request
     * @return JsonResponse
     */
    public function store(PromoCodeRequest $request): JsonResponse
    {
        try {
            $promoCode = $this->service->store($request->all());
            return $this->created(new PromoCodeResource($promoCode));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }



    /**
     * @param PromoCode $promoCode
     * @return JsonResponse
     */
    public function active(PromoCode $promoCode): JsonResponse
    {
        try {
            $promoCode = $this->service->active($promoCode);
            return $this->ok(new PromoCodeResource($promoCode));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }


    /**
     * @param PromoCode $promoCode
     * @return JsonResponse
     */
    public function inActive(PromoCode $promoCode): JsonResponse
    {
        try {
            $promoCode = $this->service->inActive($promoCode);
            return $this->ok(new PromoCodeResource($promoCode));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }


    /**
     * @param PromoCodeValidatRequest $request
     * @return JsonResponse
     */
    public function validPromoCode(PromoCodeValidatRequest $request): JsonResponse
    {
        try {
            $source_lat = $request->get("source_lat");
            $source_lon = $request->get("source_lon");
            $destination_lat = $request->get("destination_lat");
            $destination_lon = $request->get("destination_lon");

            $promoCode = $this->service->getByCode($request->get("code"));
            if (!$promoCode)
                return $this->ok(null, "The PromoCode is not found");


            $event = $promoCode->event;

            if (!$event)
                return $this->ok(null, "The event is not found");

            if (!$this->checkRadius($source_lat, $source_lon, $event->lat, $event->lon))
                return $this->ok(null, "The location of the source is outside the radius");

            if (!$this->checkRadius($destination_lat, $destination_lon, $event->lat, $event->lon))
                return $this->ok(null, "The location of the destination is outside the radius");


            $this->service->reduceAvailbleCount($promoCode);
            $polyLines = $this->getPolyLines($source_lat, $source_lon, $destination_lat, $destination_lon);

            return $this->ok(array("promoCode" => new PromoCodeResource($promoCode), "polyLines" => $polyLines));
        } catch (\Throwable $th) {
            throw $th;
            return $this->internal_error();
        }
    }
}
