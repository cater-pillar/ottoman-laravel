<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;
use App\Models\LocationName;
use App\Models\MemberType;

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
        return view('edit', [
            'household' => $household,
            'locationNames' => $locationNames,
            'memberTypes' => $memberTypes
        ]);
    }

    public function destroy($id) {
        Household::find($id)->delete();
        return redirect('households');
    }
}
