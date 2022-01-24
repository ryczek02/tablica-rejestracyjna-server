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
    'where' => ['region' => '([A-Z]{1}[0-9]{1})\b|([A-Z]{2,3})\b', 'unique' => '[A-Z0-9]{4,5}']],function () {

    Route::get('/', function($region, $unique) {
        $license_plate = \App\Models\LicensePlate::firstOrNew([
            'region' => $region,
            'unique_plate' => $unique
        ]);

        return ([
            'region' => $license_plate->region(),
            'voivodeship' => $license_plate->voivodeship(),
            'license_plate' => $license_plate
        ]);
    });

    Route::get('/comments', function($region, $unique) {
        $license_plate = \App\Models\LicensePlate::firstOrNew([
            'region' => $region,
            'unique_plate' => $unique
        ]);

        return $license_plate->comments()->with('licensePlate:id,region,unique_plate')->with('author:id,name,email')->paginate(5);
    });

});
