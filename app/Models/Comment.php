<?php

namespace App\Models;

use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements ReactableInterface
{
    use HasFactory, Reactable;

    protected $fillable = [
        'license_plate_id',
        'user_id',
        'description'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function licensePlate(){
        return $this->belongsTo(LicensePlate::class, 'license_plate_id', 'id');
    }

}
