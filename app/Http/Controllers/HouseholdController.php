<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;

class HouseholdController extends Controller
{
    public function index() {
        return view('households', [
            'households' => Household::with('memberType', 'locationName.locationType')
                                      ->limit(1000)->get()]);
    }

    public function show($id) {

        $householdIds = cache()->rememberForever('householdIds', function() {
            return Household::pluck('id')->toArray();
        });

        $prevId = $householdIds[array_search($id - 1, $householdIds)];
        $nextId = $householdIds[array_search($id + 1, $householdIds)];

        return view('household', [
            'prevId' => $prevId,
            'nextId' => $nextId,
            'household' => Household::find($id)]);
    }
}
