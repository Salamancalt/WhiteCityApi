<?php

use App\Http\Controllers\Api\EstacionController;
use App\Http\Controllers\Api\EventoController;
use App\Http\Controllers\Api\FotografiaController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\PuntosatencionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\RutaturisticaController;
use App\Http\Controllers\Api\Ruta_AccesoController;
use App\Http\Controllers\Api\RecomendadoController;
use App\Http\Controllers\Api\RestauranteController;
use App\Http\Controllers\Api\CcomercialController;
use App\Http\Controllers\Api\AutoridadsController;
use App\Http\Controllers\Api\ConvenioController;
use App\Http\Controllers\Api\LugarturisticoController;
use App\Http\Controllers\Api\TipopersonaController;
use App\Http\Controllers\Api\NotificacionController;
use App\Http\Controllers\Api\TipoconvenioController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('register',RegisterController::class)->names('api.v1.register');

Route::apiResource('rutasacceso',Ruta_AccesoController::class)->names('api.v1.rutasacceso');

Route::apiResource('rutasturisticas',RutaturisticaController::class)->names('api.v1.rutasturisticas');

Route::apiResource('recomendados',RecomendadoController::class)->names('api.v1.recomendados');

Route::apiResource('restaurantes',RestauranteController::class)->names('api.v1.restaurantes');

Route::apiResource('puntosatencion',PuntosatencionController::class)->names('api.v1.puntosatencion');

Route::apiResource('hoteles',HotelController::class)->names('api.v1.hoteles');

Route::apiResource('fotografias',FotografiaController::class)->names('api.v1.fotografias');

Route::apiResource('eventos',EventoController::class)->names('api.v1.eventos');

Route::apiResource('estaciones',EstacionController::class)->names('api.v1.estaciones');

Route::apiResource('centroscomerciales',CcomercialController::class)->names('api.v1.centroscomerciales');

Route::apiResource('autoridades',AutoridadsController::class)->names('api.v1.autoridades');

Route::apiResource('convenios',ConvenioController::class)->names('api.v1.convenios');

Route::apiResource('tipo_persona',TipopersonaController::class)->names('api.v1.tipo_persona');

Route::apiResource('lugaresturisticos',LugarturisticoController::class)->names('api.v1.lugaresturisticos');

Route::apiResource('tipo_convenios',TipoconvenioController::class)->names('api.v1.tipo_convenios');

Route::apiResource('users',UserController::class)->names('api.v1.users');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


