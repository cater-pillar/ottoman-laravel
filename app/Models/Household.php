<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        return $this->belongsToMany(Occupation::class)->withTimestamps()
                    ->withPivot('id', 'income', 'type');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class)->withTimestamps()
                    ->withPivot('id', 'amount');
    }

    public function realEstates()
    {
        return $this->belongsToMany(RealEstate::class)->withTimestamps()
                    ->withPivot('id', 'quantity', 'income', 'location', 'description');
    }

    public function lands()
    {
        return $this->belongsToMany(Land::class)->withTimestamps()
                    ->withPivot('id', 'area', 'income', 'rent', 'location', 'description');
    }

    public function livestocks()
    {
        return $this->belongsToMany(Livestock::class)->withTimestamps()
                    ->withPivot('id', 'quantity', 'income');
    }

    public function sum($table, $column) {
        return collect($this->$table)->reduce(
            function($carry, $item) use ($column) {
            return $carry + $item->pivot->$column;
            }
        );
    }



}
