<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsSelfReferencing;

class Occupation extends Model
{
    use HasFactory;
    use IsSelfReferencing;
    
    public function households()
    {
        return $this->belongsToMany(Household::class)
                    ->withPivot('income', 'type');
    }
}
