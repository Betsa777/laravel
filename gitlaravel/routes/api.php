<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

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
/*En plaçant la route logout à l'intérieur du groupe protégé par auth:sanctum,
 vous forcez Laravel à vérifier que l'utilisateur est authentifié avant d'exécuter
 la méthode logout. Cela garantit que la requête inclut un token valide, et que la
 déconnexion peut se faire en toute sécurité. */

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/logout",[AuthController::class,"logout"]);

Route::apiResource('/users',UserController::class);
});


Route::post("/signup",[AuthController::class,"signup"]);
Route::post("/login",[AuthController::class,"login"]);

