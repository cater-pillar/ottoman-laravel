<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Household;

trait HouseholdsFilter
{
    private function filterHouseholds() {
        $households = Household::with('memberType', 'locationName.locationType');

        if (request('occupations')) {
            $households->whereHas('occupations', function($q) {
                $q->where('occupations.id', request('occupations'));
            });
        };

        if (request('taxes')) {
            $households->whereHas('taxes', function($q) {
                $q->where('taxes.id', request('taxes'));
            });
        };

        if (request('locations')) {
            $households->whereHas('locationName', function($q) {
                $q->where('id', request('locations'));
            });
        };

        if (request('real_estates')) {
            $households->whereHas('realEstates', function($q) {
                $q->where('real_estates.id', request('real_estates'));
            });
        };

        if (request('lands')) {
            $households->whereHas('lands', function($q) {
                $q->where('lands.id', request('lands'));
            });
        };

        if (request('livestocks')) {
            $households->whereHas('livestocks', function($q) {
                $q->where('livestocks.id', request('livestocks'));
            });
        };

        return $households->orderBy("location_name_id", "ASC")
        ->orderBy("number", "ASC")
        ->orderBy("member_type_id", "ASC");
    }
}