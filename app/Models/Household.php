<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $this->belongsToMany(Occupation::class)
                    ->withPivot('income', 'type');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class)
                    ->withPivot('amount');
    }

    public function realEstates()
    {
        return $this->belongsToMany(RealEstate::class)
                    ->withPivot('quantity', 'income', 'location', 'description');
    }

    public function lands()
    {
        return $this->belongsToMany(Land::class)
                    ->withPivot('area', 'income', 'rent', 'location', 'description');
    }

    public function livestocks()
    {
        return $this->belongsToMany(Livestock::class)
                    ->withPivot('quantity', 'income');
    }

    public function next(){

        return static::select('id')->where('id', '>', $this->id)->orderBy('id','asc')->first();

    }

    public function previous(){

        return static::select('id')->where('id', '<', $this->id)->orderBy('id','desc')->first();

    }
}
