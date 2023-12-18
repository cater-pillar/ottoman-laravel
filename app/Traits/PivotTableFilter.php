<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\RealEstate;

trait PivotTableFilter
{
    
    private function filterByHouseholdColumns($query, $ids, $column) {
        if($ids) {
            $query->whereHas('households', function($q) use($ids, $column) {
                $q->whereIn($column, $ids);
            })->with(['households' => function ($q) use ($ids, $column) {
                $q->whereIn($column, $ids);
            }]);
        };
        return $query;
    }
    
    private function filterByHouseholdPivots($query, $ids, $pivot, $column) {
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

    private function filterPivotTables($query) {
        
        $this->filterByHouseholdColumns($query, $this->getPivotIds("location_"), 'location_name_id');
        $this->filterByHouseholdColumns($query, $this->getPivotIds("member_type_"), 'member_type_id');

/*
        $memberTypeIds = $this->getPivotIds("member_type_");
        if ($memberTypeIds) {
            $query->whereHas('households', function($q) use($memberTypeIds) {
                    $q->whereIn('member_type_id', $memberTypeIds);
            })->with(['households' => function ($q) use ($memberTypeIds) {
                $q->whereIn('member_type_id', $memberTypeIds);
            }]);
        }; */

        $this->filterByHouseholdPivots($query, $this->getPivotIds("occupation_"), 'occupations', 'household_occupation.occupation_id');
        $this->filterByHouseholdPivots($query, $this->getPivotIds("lands_"), 'lands', 'household_land.land_id');
        $this->filterByHouseholdPivots($query, $this->getPivotIds("real_estates_"), 'realEstates', 'household_real_estate.real_estate_id');

  /*      $occupationIds = $this->getPivotIds("occupation_");
        if ($occupationIds) {
            $query->whereHas('households', function($q) use($occupationIds) {
                    $q->whereHas('occupations', function($q) use($occupationIds) {
                        $q->whereIn('household_occupation.occupation_id', $occupationIds);
                    });
            })->with(['households' => function ($q) use ($occupationIds) {
                $q->whereHas('occupations', function($q) use($occupationIds) {
                    $q->whereIn('household_occupation.occupation_id', $occupationIds);
                });
            }]);
        };

        $landIds = $this->getPivotIds("lands_");
        if ($landIds) {
            $query->whereHas('households', function($q) use($landIds) {
                    $q->whereHas('lands', function($q) use($landIds) {
                        $q->whereIn('household_land.land_id', $landIds);
                    });
            })->with(['households' => function ($q) use ($landIds) {
                $q->whereHas('lands', function($q) use($landIds) {
                    $q->whereIn('household_land.land_id', $landIds);
                });
            }]);
        };

        $realEstateIds = $this->getPivotIds("real_estates_");
        if ($realEstateIds) {
            $query->whereHas('households', function($q) use($realEstateIds) {
                    $q->whereHas('realEstates', function($q) use($realEstateIds) {
                        $q->whereIn('household_real_estate.real_estate_id', $realEstateIds);
                    });
            })->with(['households' => function ($q) use ($realEstateIds) {
                $q->whereHas('realEstates', function($q) use($realEstateIds) {
                    $q->whereIn('household_real_estate.real_estate_id', $realEstateIds);
                });
            }]);
        }; */

        if(request('description')) {
            $needle = '%'.request('description').'%';
            $query->whereHas('households', function($q) use($needle) { 
                $q->where('description', 'like', $needle);
            })->with(['households' => function ($q) use ($needle) {
                $q->where('description', 'like', $needle);
            }]);
        }

        if(request('location')) {
            $needle = '%'.request('location').'%';
            $query->whereHas('households', function($q) use($needle) { 
                $q->where('location', 'like', $needle);
            })->with(['households' => function ($q) use ($needle) {
                $q->where('location', 'like', $needle);
            }]);
        }

        $realEstates = $query->get();

        return $realEstates;
    }
}