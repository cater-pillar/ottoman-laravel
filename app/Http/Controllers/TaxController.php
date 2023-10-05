<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;
use App\Models\LocationName;
use App\Models\MemberType;
use App\Models\Occupation;
use App\Models\Tax;
use App\Models\RealEstate;
use App\Models\Land;
use App\Models\Livestock;
use App\Traits\SyncVariableBuilder;
use App\Traits\HouseholdsFilter;
use App\Traits\HouseholdsCalculator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TaxController extends Controller
{
    public function index() { 
        $locationNames = LocationName::all();
        $memberTypes = MemberType::all();
        $lands = Land::all();
        $realEstates = RealEstate::all();
        $occupations = Occupation::all();
        $livestocks = Livestock::all();
        $households = Household::all();
        
        $prepare = Tax::with('households');
        
        if(request('locations')) {
            $prepare->whereHas('households',function($q) {
                $q->where('location_name_id',request('locations'));
            });
        };
        
        $taxes = $prepare->get();
   


        return view('taxes', [
            'households' => $households,
            'locationNames' => $locationNames,
            'memberTypes' => $memberTypes,
            'taxes' => $taxes,
            'realEstates' => $realEstates,
            'lands' => $lands,
            'livestocks' => $livestocks,
            'occupations' => $occupations,
        ]);
    }
}
