<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    public function households()
    {
        return $this->belongsToMany(Household::class)
                    ->withPivot('amount');
    }
}
