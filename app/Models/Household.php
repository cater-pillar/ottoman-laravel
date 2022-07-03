<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    public function locationName()
    {
        return $this->belongsTo(LocationName::class);
    }

    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class)
                    ->withPivot('income', 'type');
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class)
                    ->withPivot('amount');
    }

    public function realEstates()
    {
        return $this->hasMany(RealEstate::class)
                    ->withPivot('quantity', 'income', 'location', 'description');
    }

    public function lands()
    {
        return $this->hasMany(Land::class)
                    ->withPivot('area', 'income', 'rent', 'location', 'description');
    }

    public function livestocks()
    {
        return $this->hasMany(Livestock::class)
                    ->withPivot('quantity', 'income');
    }
}
