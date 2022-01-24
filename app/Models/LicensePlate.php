<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensePlate extends Model
{
    use HasFactory;

    protected $fillable = [
      'region',
      'unique_plate'
    ];

    private function uniqueNameSymbol(){
        return $this->region[0];
    }

    public function voivodeship(){
        return \App\Models\Voivodeship::where('symbol', $this->uniqueNameSymbol())->firstOrFail();
    }

    public function region(): object
    {
        return \App\Models\Region::where('unique_name', $this->region)->first() ?
            \App\Models\Region::where('unique_name', $this->region)->first()
            : new Region([
                'id' => 0,
                'unique_name' => $this->region,
                'administrative_area_name' => "Tablica indywidualna"
            ]);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}

