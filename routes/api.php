<?php

use App\Http\Controllers\AboutControlller;
use App\Http\Controllers\HeroViewController;
use App\Http\Controllers\MakeServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/hero-view", [HeroViewController::class, "indexAction"]);

Route::post("/create-hero-view", [HeroViewController::class, "createHeroView"]);

Route::post("/update-hero-view/{id}", [HeroViewController::class, "updateHeroView"]);

Route::post("/create-service", [MakeServiceController::class, "createService"]);

Route::post("/update-service/{serviceID}", [MakeServiceController::class, "updateService"])->whereNumber('serviceID');

Route::delete("/delete-service/{serviceID}", [MakeServiceController::class, "deleteService"]);

Route::get("/list-services", [MakeServiceController::class, "listServices"]);

Route::get("/list-about", [AboutControlller::class, "listAboutSection"]);

Route::post("create-about", [AboutControlller::class, "createAboutSection"]);

Route::post("update-about/{id}", [AboutControlller::class, "updateAboutSection"]);

Route::post("/create-clients-trustedus", [MakeServiceController::class, "createClientsTruestedus"]);

Route::get("/list-clients-trustedus", [MakeServiceController::class, "listClientsTruestedus"]);
