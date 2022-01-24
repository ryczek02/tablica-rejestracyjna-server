<?php

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/comments', \App\Http\Controllers\CommentController::class);

Route::get('/{region}', function($region){
    $region = \App\Models\Region::select('unique_name', 'administrative_area_name')->where('unique_name', $region)->firstOrFail();
    return ($region->licensePlates());
});

Route::group(['prefix' =>'/{region}/{unique}',
    'where' => [
        'region' => '([A-Z]{1}[0-9]{1})\b|([A-Z]{2,3})\b',
        'unique' => '[A-Z0-9]{4,5}']
    ]
    ,function () {

    Route::get('/', [\App\Http\Controllers\LicensePlateController::class, 'show']);
    Route::get('/comments', [\App\Http\Controllers\LicensePlateController::class, 'showComments']);

});
