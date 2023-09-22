<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsSelfReferencing;

class LocationName extends Model
{
    use HasFactory;
    use IsSelfReferencing;

            /**
     * The self referencing key on the database table.
     *
     * @var string
     */
    protected $referenceKey = 'location_name_id';

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
