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

class HouseholdController extends Controller
{
    use SyncVariableBuilder;
    use HouseholdsFilter;
    use HouseholdsCalculator;

    public function index() { 
        $locationNames = LocationName::where('location_name_id', null)->with('descendants')->get();
        $memberTypes = MemberType::all();
        $occupations = Occupation::where('occupation_id', null)->with('descendants')->get();
        $taxes = Tax::all();
        $realEstates = RealEstate::all();
        $lands = Land::all();
        $livestocks = Livestock::all();

        $households = $this->filterHouseholds();

        $count = $households->count();

        $ids = $households->pluck('id')->all();
        
        $paginated = $households->paginate(50)->withQueryString();

 

        $sums = [
            'occupation' => $this->getSum($ids,"household_occupation", "income"),
            'land' => $this->getSum($ids,"household_land", "income"),
            'realEstate' => $this->getSum($ids,"household_real_estate", "income"),
            'livestock' => $this->getSum($ids,"household_livestock", "income"),
            'tax' => $this->getSum($ids,"household_tax", "amount"),
        ];

        return view('households', [
            'households' => $paginated,
            'count' => $count,
            'sums' => $sums,
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
        $ids = $this->filterHouseholds()->pluck('id');
        $household = Household::find($id);
        
        $ids->search($id) == 0 ? $prevId = $ids->search($ids->count()-1) : $prevId = $ids[$ids->search($id)-1];
        $ids->search($id) == $ids->count()-1 ? $nextId = $ids->search(0) : $nextId = $ids[$ids->search($id)+1];
    
        return view('household', [
            'prevId' => $prevId,
            'nextId' => $nextId,
            'household' => $household]);
    }

    public function create() {
        $locationNames = LocationName::with('locationType')->get();
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
        $household->taxes()->attach($this->buildTaxes(true));
        $household->occupations()->attach($this->buildOccupations(true));
        $household->livestocks()->attach($this->buildLivestocks(true));
        $household->lands()->attach($this->buildLands(true));
        $household->realEstates()->attach($this->buildRealEstates(true));

        session(['location' => request('location_name_id'),
                 'archive_code' => request('archive_code'),
    ]);

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

        
    }

    public function destroy($id) {
        Household::find($id)->delete();
        return redirect('households')
        ->with('success', "Household successfuly deleted!");
    }
}
