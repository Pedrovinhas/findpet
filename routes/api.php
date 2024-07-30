<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('pets')->group(function () {
  Route::post('/', [PetController::class, 'create']);
  Route::get('/', [PetController::class, 'list']);


  Route::prefix('domain')->group(function () {
    Route::get('/pet-condition', [DomainController::class, 'getAllPetConditions']);
    Route::get('/breed', [DomainController::class, 'getAllBreeds']);
  }); 
});
