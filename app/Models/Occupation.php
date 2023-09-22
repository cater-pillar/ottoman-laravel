<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsSelfReferencing;

class Occupation extends Model
{
    use HasFactory;
    use IsSelfReferencing;

        /**
     * The self referencing key on the database table.
     *
     * @var string
     */
    protected $referenceKey = 'occupation_id';
    
    public function households()
    {
        return $this->belongsToMany(Household::class)
                    ->withPivot('income', 'type');
    }
}
