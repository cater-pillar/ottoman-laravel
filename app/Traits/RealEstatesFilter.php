<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\RealEstate;

trait RealEstatesFilter
{
    private function filterRealEstates($ids) {
        
        $prepare = RealEstate::query();

        if ($ids) {
            $prepare->whereHas('households', function($q) use($ids) {
                    $q->whereIn('location_name_id', $ids);
            })->with(['households' => function ($q) use ($ids) {
                $q->whereIn('location_name_id', $ids);
            }]);
        };

        if(request('description')) {
            $needle = '%'.request('description').'%';
            $prepare->whereHas('households', function($q) use($needle) { 
                $q->where('description', 'like', $needle);
            })->with(['households' => function ($q) use ($needle) {
                $q->where('description', 'like', $needle);
            }]);
        }

        if(request('location')) {
            $needle = '%'.request('location').'%';
            $prepare->whereHas('households', function($q) use($needle) { 
                $q->where('location', 'like', $needle);
            })->with(['households' => function ($q) use ($needle) {
                $q->where('location', 'like', $needle);
            }]);
        }

        $realEstates = $prepare->get();

        return $realEstates;
    }
}