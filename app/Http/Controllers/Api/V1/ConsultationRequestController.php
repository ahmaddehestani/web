<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\ConsultationRequest\StoreConsultationRequestAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsulationRequest;
use Illuminate\Http\JsonResponse;

class ConsultationRequestController extends BaseApiController
{
    public function store(ConsulationRequest $request): JsonResponse
    {
        return $this->successResponse(
            message:StoreConsultationRequestAction::run($request->validated())
        );
    }
}
