<?php

namespace App\Http\Controllers;

use App\Dtos\Pet\FilterListPet;
use App\Http\Requests\Pet\CreatePetRequest;
use App\Http\Requests\Pet\ListByFilterRequest;
use App\Services\Contracts\PetContract as PetService;

class PetController extends Controller
{
    public function __construct(
        private readonly PetService $service,
    ) {
    }

    public function create(CreatePetRequest $request)
    {
        try {
            $this->service->create($request->getData());

            return response(200);
        } catch(null) {
          //
        }
    }

    public function list(ListByFilterRequest $request)
    {
        try {
            $pets = $this->service->listByFilters($request->getFilter());

            return response()->json($pets);
        } catch(null) {
          //
        }
    }
}
