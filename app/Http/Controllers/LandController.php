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
use App\Traits\PivotTableFilter;
use App\Traits\HouseholdsCalculator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LandController extends Controller
{
    use SyncVariableBuilder;
    use PivotTableFilter;
    public function index() { 
        $locationNames = LocationName::where('location_name_id', null)
        ->with('descendants')->get();
        $memberTypes = MemberType::all();
        $taxes = Tax::all();
        $realEstates = RealEstate::all();
        $occupations = Occupation::where('occupation_id', null)->with('descendants')->get();
        $livestocks = Livestock::all();
        $households = Household::all();
        
        
        
        $lands = $this->filterPivotTables(Land::query());

        
   
        return view('lands', [
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
