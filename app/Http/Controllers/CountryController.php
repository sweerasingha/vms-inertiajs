<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use App\Models\Country;
use domain\Facades\CountryRegistryFacade\CountryRegistryFacade;
use App\Http\Requests\Country\CreateCountryRequest;
use App\Http\Requests\Country\UpdateCountryRequest;
use Illuminate\Support\Facades\Auth;

class CountryController extends ParentController
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //return Inertia::render('Settings/Country/all');

        if (Auth::user()->can('add_permissions')) {
            return Inertia::render('Settings/Country/index');
        } else {
            $response['alert-danger'] = 'You do not have permission to read countries.';
            return redirect()->route('dashboard')->with($response);
        }
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        $query = Country::orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name','code')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    /**
     * store
     *
     * @param  CreateCountryRequest $request
     * @return void
     */
    public function store(CreateCountryRequest $request)
    {
        //return CountryRegistryFacade::store($request->all());

        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create countries.';
            return redirect()->route('country.index')->with($response);
        }

    }

    /**
     * delete
     *
     * @param  int $countryId
     * @return void
     */
    public function delete(int $countryId)
    {
        //return CountryRegistryFacade::delete($countryId);

        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::delete($countryId);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete countries.';
            return redirect()->route('country.index')->with($response);
        }

    }

    /**
     * update
     *
     * @param  UpdateCountryRequest $request
     * @param  int $countryId
     * @return void
     */
    public function update(UpdateCountryRequest $request, int $country_id)
    {
        // return CountryRegistryFacade::update($request->all(),$country_id);

        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::update($request->all(),$country_id);
        } else {
            $response['alert-danger'] = 'You do not have permission to update countries.';
            return redirect()->route('country.index')->with($response);
        }

    }

    /**
     * get
     *
     * @param  int $countryId
     * @return void
     */
    public function get(int $countryId)
    {
        $payload = CountryRegistryFacade::get($countryId);
        return new DataResource($payload);
    }
    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete countries.';
            return redirect()->route('country.index')->with($response);
        }
    }

    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive countries.';
            return redirect()->route('country.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CountryRegistryFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active countries.';
            return redirect()->route('country.index')->with($response);
        }
    }
}
