<?php

use App\Http\Controllers\AuthKontroler;
use App\Http\Controllers\EvidencijaKontroler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthKontroler::class, 'register']);
Route::post('login', [AuthKontroler::class, 'login']);

Route::get('check-login/{id}', [EvidencijaKontroler::class, 'checkLogin']);
Route::get('prisustva', [EvidencijaKontroler::class, 'prisustva']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
