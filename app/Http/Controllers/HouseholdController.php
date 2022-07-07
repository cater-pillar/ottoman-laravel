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

class HouseholdController extends Controller
{
    public function index() {
        return view('households', [
            'households' => Household::with('memberType', 'locationName.locationType')
                                      ->limit(1000)->paginate(50)->withQueryString()]);
    }

    public function show($id) {

        $household = Household::find($id);
        
        $prevId = $household->previous();
        if($prevId) {$prevId = $prevId->id;}
        $nextId = $household->next();
        if($nextId) {$nextId = $nextId->id;}
        return view('household', [
            'prevId' => $prevId,
            'nextId' => $nextId,
            'household' => $household]);
    }

    public function edit($id) {
        $household = Household::find($id);
        $locationNames = LocationName::all();
        $memberTypes = MemberType::all();
        $occupations = Occupation::all();
        $taxes = Tax::all();
        $realEstates = RealEstate::all();
        $lands = Land::all();
        $livestocks = Livestock::all();
        return view('edit', [
            'household' => $household,
            'locationNames' => $locationNames,
            'memberTypes' => $memberTypes,
            'taxes' => $taxes,
            'realEstates' => $realEstates,
            'lands' => $lands,
            'livestocks' => $livestocks,
            'occupations' => $occupations,
        ]);
    }

    public function destroy($id) {
        Household::find($id)->delete();
        return redirect('households');
    }
}
