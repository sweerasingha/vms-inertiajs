<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Country;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Controllers\ParentController;
use domain\Facades\CountryRegistryFacade\CountryRegistryFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CountryController extends ParentController
{
    public function index()
    {
        if (Auth::user()->can('add_permissions')) {
            return Inertia::render('Settings/Country/index');
        } else {
            $response['alert-danger'] = 'You do not have permission to read country categories.';
            return redirect()->route('dashboard')->with($response);
        }

    }

    public function all()
    {
        $query = Country::orderBy('name');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create country categories.';
            return redirect()->route('country.index')->with($response);
        }
    }

    public function delete($countryId)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::delete($countryId);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete country categories.';
            return redirect()->route('country.index')->with($response);
        }
    }

    public function update(Request $request,$countryId)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::update($request->all(),$countryId);
        } else {
            $response['alert-danger'] = 'You do not have permission to update country categories.';
            return redirect()->route('country.index')->with($response);
        }
    }

    public function get($countryId)
    {
        $payload = CountryRegistryFacade::get($countryId);
        return new DataResource($payload);
    }

    public function list()
    {
        $countries = CountryRegistryFacade::all();
        return response()->json($countries);
    }

    public function changeStatus(int $countryId){
        return CountryRegistryFacade::changeStatus($countryId);
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete country categories.';
            return redirect()->route('country.index')->with($response);
        }

    }



    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive country categories.';
            return redirect()->route('country.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active country categories.';
            return redirect()->route('country.index')->with($response);
        }
    }
}
