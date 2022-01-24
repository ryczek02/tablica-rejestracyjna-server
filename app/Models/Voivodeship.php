<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voivodeship extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'symbol'];

    public function regions(){
        return \App\Models\Region::where('unique_name', 'LIKE', $this->symbol . '%')->get();
    }

    public function licensePlates(){
        return \App\Models\LicensePlate::where('region', 'LIKE', $this->symbol . '%')->get();
    }
}
