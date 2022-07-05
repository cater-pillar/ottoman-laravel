<?php

use Illuminate\Support\Facades\Route;
use App\Models\LocationName;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\HouseholdController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'places' => LocationName::with('locationType')
                    ->withCount(['households' => function (Builder $query) {
                    $query->where('member_type_id', 1);
                    }])->get()],
        
                );
});

Route::get('/households', [HouseholdController::class, 'index']);

Route::get('/household/{id}', [HouseholdController::class, 'show']);