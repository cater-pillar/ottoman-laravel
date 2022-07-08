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
        $taxIds = $this->getKeyValues('tax-id-');
        $taxAmounts = $this->getKeyValues('tax-amount-');
        $taxes = [];
        for ($i = 0; $i < count($taxIds); $i++) {
            $taxes[$taxIds[$i]] = ['amount' => $taxAmounts[$i]];
        }
        return $taxes;
    }
    
    private function buildOccupations() {
        $occupationIds = $this->getKeyValues('occupation-id-');
        $occupationIncomes = $this->getKeyValues('occupation-amount-');
        
        $occupations = [];
        for ($i = 0; $i < count($occupationIds); $i++) {
            $occupations[$occupationIds[$i]] = ['income' => $occupationIncomes[$i]];
        }
        return $occupations;
    }

    private function buildLivestocks() {
        $livestockIds = $this->getKeyValues('livestock-id-');
        $livestockQuantities = $this->getKeyValues('livestock-quantity-');
        $livestockIncomes = $this->getKeyValues('livestock-income-');

        $livestocks = [];
        for ($i = 0; $i < count($livestockIds); $i++) {
            $livestocks[$livestockIds[$i]] = ['quantity' => $livestockQuantities[$i], 
                                              'income' => $livestockIncomes[$i]];
        }
        return $livestocks;
    }

    private function buildLands() {
        $landIds = $this->getKeyValues('land-id-');
        $landAreas = $this->getKeyValues('land-area-');
        $landIncomes = $this->getKeyValues('land-income-');
        $landRents = $this->getKeyValues('land-rent-');
        $landDescriptions = $this->getKeyValues('land-description-');
        $landLocations = $this->getKeyValues('land-location-');
        
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
        $realEstateIds = $this->getKeyValues('real-estate-id-');
        $realEstateQuantities = $this->getKeyValues('real-estate-quantity-');
        $realEstateIncomes = $this->getKeyValues('real-estate-income-');
        $realEstateDescriptions = $this->getKeyValues('real-estate-description-');
        $realEstateLocations = $this->getKeyValues('real-estate-location-');

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