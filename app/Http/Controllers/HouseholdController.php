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
        $locationNames = LocationName::all();
        $memberTypes = MemberType::all();
        $occupations = Occupation::all();
        $taxes = Tax::all();
        $realEstates = RealEstate::all();
        $lands = Land::all();
        $livestocks = Livestock::all();

        $households = Household::with('memberType', 'locationName.locationType');

        if (request('occupations')) {
            $households->whereHas('occupations', function($q) {
                $q->where('occupations.id', request('occupations'));
            });
        };

        if (request('taxes')) {
            $households->whereHas('taxes', function($q) {
                $q->where('taxes.id', request('taxes'));
            });
        };

        if (request('locations')) {
            $households->whereHas('locationName', function($q) {
                $q->where('id', request('locations'));
            });
        };

        $households->orderBy("location_name_id", "ASC")
        ->orderBy("number", "ASC")
        ->orderBy("member_type_id", "ASC");

        $count = $households->count();


        $paginated = $households->paginate(50)->withQueryString();

        return view('households', [
            'households' => $paginated,
            'count' => $count,
            'locationNames' => $locationNames,
            'memberTypes' => $memberTypes,
            'taxes' => $taxes,
            'realEstates' => $realEstates,
            'lands' => $lands,
            'livestocks' => $livestocks,
            'occupations' => $occupations,
        ]);
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
        $household->taxes()->attach($this->buildTaxes(true));
        $household->occupations()->sync($this->buildOccupations());
        $household->occupations()->attach($this->buildOccupations(true));
        $household->livestocks()->sync($this->buildLivestocks());
        $household->livestocks()->attach($this->buildLivestocks(true));
        $household->lands()->sync($this->buildLands());
        $household->lands()->attach($this->buildLands(true));
        $household->realEstates()->sync($this->buildRealEstates());
        $household->realEstates()->attach($this->buildRealEstates(true));
        if(request('notes')) {
            $household->notes = request('notes');
           } else {
            $household->notes = '';
           }
        $household->archive_code = $attributes['archive_code'];
        $household->page = $attributes['page'];
        $household->location_name_id = $attributes['location_name_id'];
        $household->number = $attributes['number'];
        $household->forname = $attributes['forname'];
        $household->surname = $attributes['surname'];
        $household->member_type_id = $attributes['member_type_id'];

        $occupations = $this->findKeys('delete_occupation_');

        if($occupations->count() > 0) {
            foreach($occupations as $occupation) {
                $household->occupations()->wherePivot('id',str_replace('delete_occupation_','', $occupation))->detach();
            }
        }

        $taxes = $this->findKeys('delete_tax_');

        if($taxes->count() > 0) {
            foreach($taxes as $tax) {
                $household->taxes()->wherePivot('id',str_replace('delete_tax_','', $tax))->detach();
            }
        }

        $livestocks = $this->findKeys('delete_livestock_');

        if($livestocks->count() > 0) {
            foreach($livestocks as $livestock) {
                $household->livestocks()->wherePivot('id',str_replace('delete_livestock_','', $livestock))->detach();
            }
        }

        $realEstates = $this->findKeys('delete_real_estate_');

        if($realEstates->count() > 0) {
            foreach($realEstates as $realEstate) {
                $household->realEstates()->wherePivot('id',str_replace('delete_real_estate_','', $realEstate))->detach();
            }
        }


        $lands = $this->findKeys('delete_land_');

        if($lands->count() > 0) {
            foreach($lands as $land) {
                $household->lands()->wherePivot('id',str_replace('delete_land_','', $land))->detach();
            }
        }
        
        
        $household->save();
        return redirect("/household/$household->id")
        ->with('success', "Household successfuly updated!");

        /* deleting pivot entries */

        
    }

    public function destroy($id) {
        Household::find($id)->delete();
        return redirect('households')
        ->with('success', "Household successfuly deleted!");
    }
}
