<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',
        'unique_name',
        'administrative_area_name'
    ];

    private function uniqueNameSymbol(){
        return $this->unique_name[0];
    }

    public function voivodeship(){
        return \App\Models\Voivodeship::where('symbol', $this->uniqueNameSymbol())->first();
    }

    public function licensePlates(){
        return \App\Models\LicensePlate::where('region', $this->unique_name)->get();
    }
}
