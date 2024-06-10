<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Household;

trait HouseholdsFilter
{
    
    const FILTERS = array(
                [
                'requestName' => 'occupations',
                'logic' => ['any', 'none', 'all'],
                'pivotName' => 'occupations',
                'referenceColumn' => 'occupations.id'
                ],
                [
                'requestName' => 'occupation_income',
                'logic' => ['>', '<', '='],
                'pivotName' => 'occupations',
                'referenceColumn' => 'income'
                ],
                [
                'requestName' => 'taxes',
                'logic' => ['any', 'none', 'all'],
                'pivotName' => 'taxes',
                'referenceColumn' => 'taxes.id'
                ],
                [
                'requestName' => 'tax_amount',
                'logic' => ['>', '<', '='],
                'pivotName' => 'taxes',
                'referenceColumn' => 'amount'
                ],
                [
                'requestName' => 'locations',
                'logic' => ['any', 'none'],
                'pivotName' => 'locationName',
                'referenceColumn' => 'id'
                ],
                [
                'requestName' => 'member_type',
                'logic' => ['any', 'none'],
                'pivotName' => 'memberType',
                'referenceColumn' => 'id'
                ],
                [
                'requestName' => 'real_estates',
                'logic' => ['any', 'none', 'all'],
                'pivotName' => 'realEstates',
                'referenceColumn' => 'real_estates.id'
                ],
                [
                'requestName' => 'real_estate_income',
                'logic' => ['>', '<', '='],
                'pivotName' => 'realEstates',
                'referenceColumn' => 'income'
                ],
                [
                'requestName' => 'real_estate_quantity',
                'logic' => ['>', '<', '='],
                'pivotName' => 'realEstates',
                'referenceColumn' => 'quantity'
                ],
                [
                'requestName' => 'lands',
                'logic' => ['any', 'none', 'all'],
                'pivotName' => 'lands',
                'referenceColumn' => 'lands.id'
                ],
                [
                'requestName' => 'land_area',
                'logic' => ['>', '<', '='],
                'pivotName' => 'lands',
                'referenceColumn' => 'area'
                ],
                [
                'requestName' => 'land_income',
                'logic' => ['>', '<', '='],
                'pivotName' => 'lands',
                'referenceColumn' => 'income'
                ],
                [
                'requestName' => 'land_rent',
                'logic' => ['>', '<', '='],
                'pivotName' => 'lands',
                'referenceColumn' => 'rent'
                ],
                [
                'requestName' => 'livestocks',
                'logic' => ['any', 'none', 'all'],
                'pivotName' => 'livestocks',
                'referenceColumn' => 'livestocks.id'
                ],
                [
                'requestName' => 'livestock_quantity',
                'logic' => ['>', '<', '='],
                'pivotName' => 'livestocks',
                'referenceColumn' => 'quantity'
                ],
                [
                'requestName' => 'livestocks_income',
                'logic' => ['>', '<', '='],
                'pivotName' => 'livestocks',
                'referenceColumn' => 'income'
                ],
                [
                'requestName' => 'notes',
                'logic' => ['contains', 'lacks'],
                'pivotName' => '',
                'referenceColumn' => 'notes'
                ],
                [
                'requestName' => 'forname',
                'logic' => ['contains', 'lacks'],
                'pivotName' => '',
                'referenceColumn' => 'forname'
                ],
                [
                'requestName' => 'surname',
                'logic' => ['contains', 'lacks'],
                'pivotName' => '',
                'referenceColumn' => 'surname'
                ],
                [
                'requestName' => 'total_income',
                'logic' => ['>', '<', '='],
                'pivotName' => '',
                'referenceColumn' => ''
                ],
            );

    private function applyAnyFilter($filter, $ids, $households)
        {
            $households->whereHas($filter['pivotName'], function($q) use($ids, $filter) {
                $q->whereIn($filter['referenceColumn'], $ids);
            });
        }

    private function applyNoneFilter($filter, $ids, $households)
        {
            $households->whereDoesntHave($filter['pivotName'], function($q) use($ids, $filter) {
                $q->whereIn($filter['referenceColumn'], $ids);
            });
        }

    private function applyAllFilter($filter, $ids, $households)
        {
            $households->where(function($query) use($ids, $filter) {
                foreach ($ids as $id) {
                    $query->whereHas($filter['pivotName'], function($q) use ($id, $filter) {
                        $q->where($filter['referenceColumn'], $id);
                    });
                }
            });
        }

    private function applyContainsFilter($filter, $ids, $households, $requestName)
        {
            foreach ($ids as $id) {
                $fullRequestName = $requestName . $id;
                $needle = '%' . request($fullRequestName) . '%';
                $households->where($filter['referenceColumn'], 'like', $needle);
            }
        }

    private function applyLacksFilter($filter, $ids, $households, $requestName)
        {
            foreach ($ids as $id) {
                $fullRequestName = $requestName . $id;
                $needle = '%' . request($fullRequestName) . '%';
                $households->where($filter['referenceColumn'], 'not like', $needle);
            }
        }

    private function applyComparisonFilter($filter, $ids, $households, $requestName, $operator)
        {
            foreach ($ids as $id) {
                $fullRequestName = $requestName . $id;
                $requestValue = request($fullRequestName);
                $column = $filter['referenceColumn'];
                $households->has($filter['pivotName'])
                    ->whereHas($filter['pivotName'], function($q) use($requestValue, $column, $operator) {
                        $q->selectRaw("SUM({$column}) as total")
                          ->having('total', $operator, $requestValue);
                    });
            }
        }

    private function applyTotalIncomeFilter($ids, $households, $operator)
        {
                foreach($ids as $id) {
                    $requestName = 'total_income_' . $operator . '_' . $id;
                    $requestValue = request($requestName);
                    $households->where(function ($query) use ($operator, $requestValue) {
                        $query->whereRaw('(
                            (
                                SELECT COALESCE(SUM(household_occupation.income), 0)
                                FROM household_occupation
                                WHERE household_occupation.household_id = households.id
                            ) + (
                                SELECT COALESCE(SUM(household_real_estate.income), 0)
                                FROM household_real_estate
                                WHERE household_real_estate.household_id = households.id
                            ) + (
                                SELECT COALESCE(SUM(household_land.income), 0)
                                FROM household_land
                                WHERE household_land.household_id = households.id
                            ) + (
                                SELECT COALESCE(SUM(household_livestock.income), 0)
                                FROM household_livestock
                                WHERE household_livestock.household_id = households.id
                            )
                        ) ' . $operator . ' ?', [$requestValue]);
                    });
                }
        }


    private function filtering($filter, $households) {

        foreach ($filter['logic'] as $logic) {
            $requestName = $filter['requestName'] . '_' . $logic . '_';
            $ids = $this->getPivotIds($requestName);
            if($ids) {
                switch ($logic) {
                    case 'any': 
                        $this->applyAnyFilter($filter, $ids, $households);
                    break;
                    case 'none' :
                        $this->applyNoneFilter($filter, $ids, $households);
                    break;
                    case 'all' :
                        $this->applyAllFilter($filter, $ids, $households);
                    break;                   
                    case 'contains' :
                        $this->applyContainsFilter($filter, $ids, $households, $requestName);
                    break;                   
                    case 'lacks' :
                        $this->applyLacksFilter($filter, $ids, $households, $requestName);     
                    break;
                    case '>':
                    case '<':
                    case '=':
                        if ($filter['requestName'] == 'total_income') {
                            $this->applyTotalIncomeFilter($ids, $households, $logic);
                        } else {
                            $this->applyComparisonFilter($filter, $ids, $households, $requestName, $logic);
                        }
                        break;                                         
                }
            } 
        }
    }

    private function filterHouseholds() {
        $households = Household::with('memberType', 'locationName.locationType');

        foreach (self::FILTERS as $filter) {
            $this->filtering($filter, $households);
        };  

        return $households->orderBy("location_name_id", "ASC")
        ->orderBy("number", "ASC")
        ->orderBy("member_type_id", "ASC");
    }
}