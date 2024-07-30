<?php

namespace App\Http\Controllers;

use App\Constants\ErrorMessage;
use App\Services\Contracts\DomainContract as DomainService;

class DomainController extends Controller
{
  public function __construct(
    private readonly DomainService $domainService
  ) {
    parent::__construct();
  }

  public function getAllBreeds()
  {
    try {
      $breeds = $this->domainService->getAllBreeds();

      return response()->json($breeds);
    } catch (\Throwable $th) {

      $this->log('getAllBreeds', $th);

      // return errorResponse(500, ErrorMessage::INTERNAL_SERVER_ERROR);
    }
  }

  public function getAllPetConditions()
  {
    try {
      $petConditions = $this->domainService->getAllPetConditions();

      return response()->json($petConditions);
    } catch (\Throwable $th) {

      $this->log('getAllPetConditions', $th);

      // return errorResponse(500, ErrorMessage::INTERNAL_SERVER_ERROR);
    }
  }
}
