<?php

use App\Http\Controllers\PracticeController;
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

Route::controller(PracticeController::class)->group(function(){
    Route::get('/users', 'getUsers');

    Route::get('/collection-intro', 'collectionIntro');
    Route::get('/collection-macro', 'collectionMacro');
    Route::get('/collection-macro-arguments', 'collectionMacroArguments');
});
