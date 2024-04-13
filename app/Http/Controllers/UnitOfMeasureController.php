<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\UnitOfMeasure;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Controllers\ParentController;
use domain\Facades\UnitOfMeasureFacade\UnitOfMeasureFacade;
use Illuminate\Support\Facades\Auth;


class UnitOfMeasureController extends ParentController
{
    // use FormHelper;

    public function index()
    {
        if (Auth::user()->can('read_unit_measurements')) {
            return Inertia::render('Settings/UnitOfMeasure/all');
        } else {
            $response['alert-danger'] = 'You do not have permission to read unit measurements.';
            return redirect()->route('dashboard')->with($response);
        }

    }

    public function all()
    {
        $query = UnitOfMeasure::orderBy('name');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return UnitOfMeasureFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create unit measurements.';
            return redirect()->route('measurement.index')->with($response);
        }
    }

    public function delete($unitId)
    {
        if (Auth::user()->can('add_permissions')) {
            return UnitOfMeasureFacade::delete($unitId);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete unit measurements.';
            return redirect()->route('measurement.index')->with($response);
        }
    }

    public function update(Request $request,$unitId)
    {
        if (Auth::user()->can('add_permissions')) {
            return UnitOfMeasureFacade::update($request->all(),$unitId);
        } else {
            $response['alert-danger'] = 'You do not have permission to update unit measurements.';
            return redirect()->route('measurement.index')->with($response);
        }
    }

    public function get($unitId)
    {
        $payload = UnitOfMeasureFacade::get($unitId);
        return new DataResource($payload);
    }

    public function list()
    {
        $units = UnitOfMeasureFacade::all();
        return response()->json($units);
    }

    public function changeStatus(int $unitId){
        return UnitOfMeasureFacade::changeStatus($unitId);
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return UnitOfMeasureFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete unit measurements.';
            return redirect()->route('measurement.index')->with($response);
        }

    }



    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return UnitOfMeasureFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive unit measurements.';
            return redirect()->route('measurement.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return UnitOfMeasureFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active unit measurements.';
            return redirect()->route('measurement.index')->with($response);
        }
    }
}
