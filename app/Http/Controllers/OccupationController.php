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

class OccupationController extends Controller
{
    use SyncVariableBuilder;
    public function index() { 
        $locationNames = LocationName::where('location_name_id', null)->with('descendants')->get();
        $memberTypes = MemberType::all();
        $taxes = Tax::all();
        $realEstates = RealEstate::all();
        $lands = Land::all();
        $livestocks = Livestock::all();
        $households = Household::all();
        
        $prepare = Occupation::with('households');

        $locationIds = $this->getPivotIds("location_");

        if ($locationIds) {
            $prepare->whereHas('households', function($q) use($locationIds) {
                    $q->whereIn('location_name_id', $locationIds);
            });
        };

        
        $occupations = $prepare->get();



        return view('occupations', [
            'households' => $households,
            'locationNames' => $locationNames,
            'memberTypes' => $memberTypes,
            'taxes' => $taxes,
            'realEstates' => $realEstates,
            'lands' => $lands,
            'livestocks' => $livestocks,
            'occupations' => $occupations,
            'locationIds' => $locationIds,
        ]);
    }


}
