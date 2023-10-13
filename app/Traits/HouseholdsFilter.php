<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Household;

trait HouseholdsFilter
{
    private function filterHouseholds() {
        $households = Household::with('memberType', 'locationName.locationType');

        $occupationIds = $this->getPivotIds("occupation_");
        if ($occupationIds) {
            $households->whereHas('occupations', function($q) use($occupationIds) {
                    $q->whereIn('occupations.id', $occupationIds);
            });
        };

        $taxIds = $this->getPivotIds('taxes_');
        if ($taxIds) {
            $households->whereHas('taxes', function($q) use($taxIds){
                $q->whereIn('taxes.id', $taxIds);
            });
        };


        $locationIds = $this->getPivotIds("location_");

        if ($locationIds) {
            $households->whereHas('locationName', function($q) use($locationIds) {
                    $q->whereIn('id', $locationIds);
            });
        };

        $memberIds = $this->getPivotIds('member_type_');
        if ($memberIds) {
            $households->whereHas('memberType', function($q) use($memberIds) {
                $q->whereIn('id', $memberIds);
            });
        };

        $realEstateIds = $this->getPivotIds('real_estates_');
        if ($realEstateIds) {
            $households->whereHas('realEstates', function($q) use($realEstateIds) {
                $q->whereIn('real_estates.id', $realEstateIds);
            });
        };

        $landIds = $this->getPivotIds('lands_');
        if ($landIds) {
            $households->whereHas('lands', function($q) use($landIds) {
                $q->whereIn('lands.id', $landIds);
            });
        };

        $livestockIds = $this->getPivotIds('livestocks_');
        if ($livestockIds) {
            $households->whereHas('livestocks', function($q) use($livestockIds) {
                $q->whereIn('livestocks.id', $livestockIds);
            });
        };



        return $households->orderBy("location_name_id", "ASC")
        ->orderBy("number", "ASC")
        ->orderBy("member_type_id", "ASC");
    }
}