<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Land;

trait LandsFilter
{
    private function filterLands($ids) {
        
        $prepare = Land::with('households');

        if ($ids) {
            $prepare->whereHas('households', function($q) use($ids) {
                    $q->whereIn('location_name_id', $ids);
            });
        };

        $lands = $prepare->get();

        return $lands;
    }
}