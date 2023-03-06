<?php

use App\Http\Controllers\LandPropertiesController;
use App\Http\Controllers\LandPropertyInfoController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PeopleController::class, 'index'])->name('home');
Route::get('/people', [PeopleController::class, 'index'])->name('home');
Route::get('/overview', [OverviewController::class, 'index'])->name('overview');

Route::get('/people/create', [PeopleController::class, 'create'])->name('people.create');
Route::post('/people/store', [PeopleController::class, 'store'])->name('people.store');

Route::get('/people/{id}', [PeopleController::class, 'show'])->name('people.show');

Route::get('/people/{people_id}/land-properties/create', [LandPropertiesController::class, 'create'])->name('land-properties.create');
Route::post('/people/{people_id}/land-properties/store', [LandPropertiesController::class, 'store'])->name('land-properties.store');
Route::get('/people/{people_id}/land-properties/{land_property_id}', [LandPropertiesController::class, 'show'])->name('land-properties.show');
Route::get('/people/{people_id}/land-properties/{land_property_id}/edit', [LandPropertiesController::class, 'edit'])->name('land-properties.edit');
Route::put('/people/{people_id}/land-properties/{land_property_id}/update', [LandPropertiesController::class, 'update'])->name('land-properties.update');

Route::get('/people/{people_id}/land-property-info/{land_property_id}/create', [LandPropertyInfoController::class, 'create'])->name('land-property-info.create');
Route::post('/people/{people_id}/land-property-info/{land_property_id}/store', [LandPropertyInfoController::class, 'store'])->name('land-property-info.store');
Route::get('/people/{people_id}/land-property-info/{land_property_id}/{land_property_info_id}/edit', [LandPropertyInfoController::class, 'edit'])->name('land-property-info.edit');
Route::put('/people/{people_id}/land-property-info/{land_property_id}/{land_property_info_id}/update', [LandPropertyInfoController::class, 'update'])->name('land-property-info.update');
