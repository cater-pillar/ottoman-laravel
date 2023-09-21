<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Household;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait HouseholdsCalculator
{

    /**  receives an array of household ids and gets a related sum
     * of a requested column from a requested pivot table
     */
    private function getSum(array $ids, string $table, string $column) {
        return DB::table($table)->whereIn('household_id',$ids)->sum($column);
    }

}