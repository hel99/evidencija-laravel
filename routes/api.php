<?php

use App\Http\Controllers\AuthKontroler;
use App\Http\Controllers\EvidencijaKontroler;
use App\Http\Controllers\ZaposleniKontroler;
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
Route::get('kasnjenja', [EvidencijaKontroler::class, 'kasnjenja']);


Route::get('zaposleni', [ZaposleniKontroler::class, 'zaposleni']);
Route::get('zaposleni-search/{input}', [ZaposleniKontroler::class, 'zaposleniSearch']);
Route::get('zaposleni-sort/{sortiranje}', [ZaposleniKontroler::class, 'zaposleniSort']);
Route::delete('zaposleni-delete/{idZaposleni}', [ZaposleniKontroler::class, 'zaposleniDelete']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
