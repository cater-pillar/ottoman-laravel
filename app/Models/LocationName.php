<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationName extends Model
{
    use HasFactory;

    public function locationName()
    {
        return $this->belongsTo(LocationName::class);
    }

    public function locationType()
    {
        return $this->belongsTo(LocationType::class);
    }

    public function households()
    {
        return $this->hasMany(Household::class);
    }
}
