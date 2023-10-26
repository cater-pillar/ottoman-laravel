<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\RealEstate;

trait RealEstatesFilter
{
    private function filterRealEstates($ids) {
        
        $prepare = RealEstate::with('households');

        if ($ids) {
            $prepare->whereHas('households', function($q) use($ids) {
                    $q->whereIn('location_name_id', $ids);
            });
        };

        $realEstates = $prepare->get();

        return $realEstates;
    }
}