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
use Illuminate\Support\Facades\DB;

class HouseholdController extends Controller
{
    use SyncVariableBuilder;

    public function index() { 
        return view('households', [
            'households' => Household::with('memberType', 'locationName.locationType')
            ->orderBy("location_name_id", "ASC")
            ->orderBy("number", "ASC")
            ->orderBy("member_type_id", "ASC")
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

    public function create() {
        $locationNames = LocationName::all();
        $memberTypes = MemberType::all();
        $occupations = Occupation::all();
        $taxes = Tax::all();
        $realEstates = RealEstate::all();
        $lands = Land::all();
        $livestocks = Livestock::all();
        return view('create', [
            'locationNames' => $locationNames,
            'memberTypes' => $memberTypes,
            'taxes' => $taxes,
            'realEstates' => $realEstates,
            'lands' => $lands,
            'livestocks' => $livestocks,
            'occupations' => $occupations,
        ]);
    }

    public function store() {
        $attributes = request()->validate([
            'archive_code' => ['required'],
            'page' => ['required'],
            'location_name_id' => ['required'],
            'number' => ['required'],
            'forname' => [''],
            'surname' => [''],
            'member_type_id' => ['required'],
            'notes' => [''],
        ]);
        $household = Household::create($attributes);
        $household->taxes()->attach($this->buildTaxes());
        $household->occupations()->attach($this->buildOccupations());
        $household->livestocks()->attach($this->buildLivestocks());
        $household->lands()->attach($this->buildLands());
        $household->realEstates()->attach($this->buildRealEstates());

        $household->save();
        return redirect("/household/$household->id")
        ->with('success', "Household successfuly stored!");
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

    public function update($id) {

        $attributes = request()->validate([
            'archive_code' => ['required'],
            'page' => ['required'],
            'location_name_id' => ['required'],
            'number' => ['required'],
            'forname' => ['required'],
            'surname' => ['required'],
            'member_type_id' => ['required'],
        ]);
       
        $household = Household::find($id);
        $household->taxes()->sync($this->buildTaxes());
        $household->occupations()->sync($this->buildOccupations());
        $household->livestocks()->sync($this->buildLivestocks());
        $household->lands()->sync($this->buildLands());
        $household->realEstates()->sync($this->buildRealEstates());
        if(request('notes')) {
            $household->notes = request('notes');
           }
        $household->archive_code = $attributes['archive_code'];
        $household->page = $attributes['page'];
        $household->location_name_id = $attributes['location_name_id'];
        $household->number = $attributes['number'];
        $household->forname = $attributes['forname'];
        $household->surname = $attributes['surname'];
        $household->member_type_id = $attributes['member_type_id'];
        $household->save();
        return redirect("/household/$household->id")
        ->with('success', "Household successfuly updated!");
        
    }

    public function destroy($id) {
        Household::find($id)->delete();
        return redirect('households');
    }
}
