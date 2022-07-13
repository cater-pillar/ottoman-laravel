<?php
namespace App\Traits;

trait SyncVariableBuilder {

    private function findKeys($needle) {
        return collect(request()->keys())->filter(
            fn($key) => str_contains($key, $needle) && $key);
    }
    
    private function getKeyValues($needle) {
        $ids = [];
        foreach($this->findKeys($needle) as $key) {
            array_push($ids, request($key));
        }
        return $ids;
    }

    private function buildTaxes() {
        $taxIds = $this->getKeyValues('tax_id_');
        $taxAmounts = $this->getKeyValues('tax_amount_');
        $taxes = [];
        for ($i = 0; $i < count($taxIds); $i++) {
            $taxes[$taxIds[$i]] = ['amount' => $taxAmounts[$i]];
        }
        return $taxes;
    }
    
    private function buildOccupations() {
        $occupationIds = $this->getKeyValues('occupation_id_');
        $occupationIncomes = $this->getKeyValues('occupation_income_');
        
        $occupations = [];
        for ($i = 0; $i < count($occupationIds); $i++) {
            $occupations[$occupationIds[$i]] = ['income' => $occupationIncomes[$i]];
        }
        return $occupations;
    }

    private function buildLivestocks() {
        $livestockIds = $this->getKeyValues('livestock_id_');
        $livestockQuantities = $this->getKeyValues('livestock_quantity_');
        $livestockIncomes = $this->getKeyValues('livestock_income_');

        $livestocks = [];
        for ($i = 0; $i < count($livestockIds); $i++) {
            $livestocks[$livestockIds[$i]] = ['quantity' => $livestockQuantities[$i], 
                                              'income' => $livestockIncomes[$i]];
        }
        return $livestocks;
    }

    private function buildLands() {
        $landIds = $this->getKeyValues('land_id_');
        $landAreas = $this->getKeyValues('land_area_');
        $landIncomes = $this->getKeyValues('land_income_');
        $landRents = $this->getKeyValues('land_rent_');
        $landDescriptions = $this->getKeyValues('land_description_');
        $landLocations = $this->getKeyValues('land_location_');
        
        $lands = [];
        for ($i = 0; $i < count($landIds); $i++) {
            $lands[$landIds[$i]] = ['area' => $landAreas[$i], 
                                    'income' => $landIncomes[$i],
                                    'rent' => $landRents[$i],
                                    'location' => $landLocations[$i],
                                    'description' => $landDescriptions[$i],
                                ];
        }
        return $lands;
    }

    private function buildRealEstates() {
        $realEstateIds = $this->getKeyValues('real_estate_id_');
        $realEstateQuantities = $this->getKeyValues('real_estate_quantity_');
        $realEstateIncomes = $this->getKeyValues('real_estate_income_');
        $realEstateDescriptions = $this->getKeyValues('real_estate_description_');
        $realEstateLocations = $this->getKeyValues('real_estate_location_');

        $realEstates = [];
        for ($i = 0; $i < count($realEstateIds); $i++) {
            $realEstates[$realEstateIds[$i]] = ['quantity' => $realEstateQuantities[$i], 
                                    'income' => $realEstateIncomes[$i],
                                    'location' => $realEstateLocations[$i],
                                    'description' => $realEstateDescriptions[$i],
                                ];
        }
        return $realEstates;
    }
}