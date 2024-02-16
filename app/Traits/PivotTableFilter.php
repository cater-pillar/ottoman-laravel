<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\RealEstate;

trait PivotTableFilter
{
    
    private function filterByHouseholdColumns(Builder $query, array $ids, string $column) {
        if($ids) {
            $query->whereHas('households', function($q) use($ids, $column) {
                $q->whereIn($column, $ids);
            })->with(['households' => function ($q) use ($ids, $column) {
                $q->whereIn($column, $ids);
            }]);
        };
        return $query;
    }
    
    private function filterByHouseholdPivots(Builder $query, array $ids, string $pivot, string $column) {
        if ($ids) {
            $query->whereHas('households', function($q) use($ids, $pivot, $column) {
                    $q->whereHas($pivot, function($q) use($ids, $column) {
                        $q->whereIn($column, $ids);
                    });
            })->with(['households' => function ($q) use ($ids, $pivot, $column) {
                $q->whereHas($pivot, function($q) use($ids, $column) {
                    $q->whereIn($column, $ids);
                });
            }]);
        };
        return $query;
    }
    private function filterByText(Builder $query, ?string $needle, string $column) {
        if($needle) {
            $needle = '%'.$needle.'%';
            $query->whereHas('households', function($q) use($needle, $column) { 
                $q->where($column, 'like', $needle);
            })->with(['households' => function ($q) use ($needle, $column) {
                $q->where($column, 'like', $needle);
            }]);
        }
    }

    private function filterPivotTables(Builder $query) {
        
        $this->filterByHouseholdColumns($query, $this->getPivotIds("location_"), 'location_name_id');
        $this->filterByHouseholdColumns($query, $this->getPivotIds("member_type_"), 'member_type_id');

        $this->filterByHouseholdPivots($query, $this->getPivotIds("occupation_"), 'occupations', 'household_occupation.occupation_id');
        $this->filterByHouseholdPivots($query, $this->getPivotIds("lands_"), 'lands', 'household_land.land_id');
        $this->filterByHouseholdPivots($query, $this->getPivotIds("real_estates_"), 'realEstates', 'household_real_estate.real_estate_id');

        $this->filterByText($query, request('description'), 'description');
        $this->filterByText($query, request('location'), 'location');

        $result = $query->get();
        return $result;
    }
}