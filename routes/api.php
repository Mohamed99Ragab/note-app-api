<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



//  Auth
    Route::post('signIn',[AuthController::class,'login']);
    Route::post('signUp',[AuthController::class,'register']);
    Route::post('logout',[AuthController::class,'logout']);



Route::group(['middleware'=>'jwt.verify'],function (){

//  Notes
    Route::get('all-notes',[NoteController::class,'index']);
    Route::post('add-note',[NoteController::class,'store']);
    Route::get('show-note/{id}',[NoteController::class,'show']);
    Route::put('update-note/{id}',[NoteController::class,'update']);
    Route::delete('delete-note/{id}',[NoteController::class,'destroy']);

});
