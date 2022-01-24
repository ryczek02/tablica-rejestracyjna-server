<?php

namespace App\Http\Controllers;

use App\Models\LicensePlate;
use Illuminate\Http\Request;

class LicensePlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LicensePlate  $licensePlate
     * @return array
     */
    public function show($region, $unique)
    {
        $license_plate = \App\Models\LicensePlate::firstOrNew([
            'region' => $region,
            'unique_plate' => $unique
        ]);

        return ([
            'region' => $license_plate->region(),
            'voivodeship' => $license_plate->voivodeship(),
            'license_plate' => $license_plate
        ]);
    }

    public function showComments($region, $unique){
        $license_plate = \App\Models\LicensePlate::firstOrNew([
            'region' => $region,
            'unique_plate' => $unique
        ]);

        return $license_plate->comments()->with('licensePlate:id,region,unique_plate')->with('author:id,name,email')->paginate(5);
    }

}
