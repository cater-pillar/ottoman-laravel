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
        return view('household', [
            'household' => Household::find($id)]);
    }
}
