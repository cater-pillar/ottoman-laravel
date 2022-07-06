<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;

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
}
