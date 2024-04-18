<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Vehicle;
use App\Filters\FuzzyFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\ParentController;
use domain\Facades\VehicleFacade\VehicleFacade;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;

class VehicleController extends ParentController
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('Vehicle/index');

    }

    /**
     * store
     *
     * @param  CreateVehicleRequest $request
     * @return void
     */
    public function store(CreateVehicleRequest $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create vehicles.';
            return redirect()->route('vehicles.index')->with($response);
        }

    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        $query = Vehicle::orderBy('id', 'desc');
        if(request('search_vehicle_code'))
        {
            $code = request('search_vehicle_code');
            $query->where('code', $code);
        }
        if(request('search_vehicle_name'))
        {
            $name = request('search_vehicle_name');
            $query->where('name', 'like', "%{$name}%");
        }
        if(request('search_vehicle_country'))
        {
            $country_id = request('search_vehicle_country');
            $query->where('country_id', $country_id);
        }
        if(request('search_vehicle_category'))
        {
            $vehicle_category_id = request('search_vehicle_category');
            $query->where('vehicle_category_id', $vehicle_category_id);
        }
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['code'])
            ->allowedFilters(
                AllowedFilter::callback('search', function($query, $value){
                    $query->whereHas('countries', function(Builder $query) use ($value){
                        $query->where('name', 'like', "%{$value}%");
                    });
                    $query->orWhereHas('vehicle_categories', function(Builder $query) use ($value){
                        $query->where('name', 'like', "%{$value}%");
                    });
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('name', 'like', "%{$value}%");
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    /**
     * delete
     *
     * @param  int $id
     * @return void
     */
    public function delete(int $id)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleFacade::delete($id);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete vehicles.';
            return redirect()->route('vehicles.index')->with($response);
        }

    }

    /**
     * edit
     *
     * @param  int $id
     * @return void
     */
    public function edit(int $id)
    {
        if (Auth::user()) {
            $response['vehicle'] = VehicleFacade::get($id);
            Log::info('Response:', $response);
            return Inertia::render('Vehicle/edit', $response);
        } else {
            $response['alert-danger'] = 'You do not have permission to edit vehicles.';
            return redirect()->route('vehicles.index')->with($response);
        }

        // if (Auth::user()->can('view_vehicle')) {
        //     $response['vehicle'] = VehicleFacade::get($id);
        //     return Inertia::render('vehicles/edit', $response);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to edit vehicles.';
        //     return redirect()->route('vehicles.index')->with($response);
        // }

    }

    /**
     * get
     *
     * @param  int $id
     * @return void
     */
    public function get(int $id)
    {
        $payload = VehicleFacade::get($id);
        return new DataResource($payload);
    }

    /**
     * basicUpdate
     *
     * @param  UpdateVehicleRequest $request
     * @param  int $id
     * @return void
     */
    public function basicUpdate(UpdateVehicleRequest $request, int $id)
    {
        return VehicleFacade::update($request->all(), $id);

    }

    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive vehicles.';
            return redirect()->route('vehicles.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active vehicles.';
            return redirect()->route('vehicles.index')->with($response);
        }
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VehicleFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete vehicles.';
            return redirect()->route('vehicles.index')->with($response);
        }

    }
}
