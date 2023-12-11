<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Tax;

trait TaxesFilter
{
    private function filterTaxes($ids) {
        
        $prepare = Tax::query();

        if ($ids) {
            $prepare->whereHas('households', function($q) use($ids) {
                    $q->whereIn('location_name_id', $ids);
            })
            ->with(['households' => function ($q) use ($ids) {
                $q->whereIn('location_name_id', $ids);
            }]);
        };

        $taxes = $prepare->get();

        return $taxes;
    }
}