<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Occupation;

trait OccupationsFilter
{
    private function filterOccupations($ids) {
        
        $prepare = Occupation::query();

        if ($ids) {
            $prepare->whereHas('households', function($q) use($ids) {
                    $q->whereIn('location_name_id', $ids);
            })
            ->with(['households' => function ($q) use ($ids) {
                $q->whereIn('location_name_id', $ids);
            }]);
        };

        $occupations = $prepare->get();

        return $occupations;
    }
}