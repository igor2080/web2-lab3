<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ManufacturerController;


Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'country');
Route::resource('country', CountryController::class);
Route::get('{countryslug}/manufacturer', [ManufacturerController::class, 'index']);
Route::get('{countryslug}/manufacturer/create', [ManufacturerController::class, 'create']);
Route::get('/manufacturer/{id}/models', [ManufacturerController::class, 'show']);
Route::get('/manufacturer/{id}/create', [ManufacturerController::class, 'create_model']);
Route::resource('manufacturer', ManufacturerController::class, ['except' => ['index', 'create', 'show']]);
Route::post('/manufacturer/store_model', [ManufacturerController::class, 'store_model']);