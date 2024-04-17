<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\VehicleCategory;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Controllers\ParentController;
use domain\Facades\VehicleCategoryFacade\VehicleCategoryFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VehicleCategoryController extends ParentController
{
    public function index()
    {
        if (Auth::user()->can('add_permissions')) {
            return Inertia::render('Settings/VehicleCategory/index');
        } else {
            $response['alert-danger'] = 'You do not have permission to read vehicle categories.';
            return redirect()->route('dashboard')->with($response);
        }

    }

    public function all()
    {
        Log::info('VehicleCategoryController.all');
        $query = VehicleCategory::orderBy('name');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleCategoryFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create vehicle categories.';
            return redirect()->route('vehicle-category.index')->with($response);
        }
    }

    public function delete($vehicleId)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleCategoryFacade::delete($vehicleId);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete vehicle categories.';
            return redirect()->route('vehicle-category.index')->with($response);
        }
    }

    public function update(Request $request,$vehicleId)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleCategoryFacade::update($request->all(),$vehicleId);
        } else {
            $response['alert-danger'] = 'You do not have permission to update vehicle categories.';
            return redirect()->route('vehicle-category.index')->with($response);
        }
    }

    public function get($vehicleId)
    {
        $payload = VehicleCategoryFacade::get($vehicleId);
        return new DataResource($payload);
    }

    public function list()
    {
        $vehicles = VehicleCategoryFacade::all();
        return response()->json($vehicles);
    }

    public function changeStatus(int $vehicleId){
        return VehicleCategoryFacade::changeStatus($vehicleId);
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleCategoryFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete vehicle categories.';
            return redirect()->route('vehicle-category.index')->with($response);
        }

    }



    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleCategoryFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive vehicle categories.';
            return redirect()->route('vehicle-category.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleCategoryFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active vehicle categories.';
            return redirect()->route('vehicle-category.index')->with($response);
        }
    }
}
