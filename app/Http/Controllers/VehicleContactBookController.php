<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vehicle\UpdateContactBookRequest;
use domain\Facades\VehicleContactFacade\VehicleContactFacade;
use App\Models\VehicleContactBook;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Auth;

class VehicleContactBookController extends ParentController
{
    /**
     * update
     *
     * @param  UpdateContactBookRequest $request
     * @param  int $vehicleId
     * @return void
     */
    public function update(UpdateContactBookRequest $request, int $vehicleId)
    {

        // if (Auth::user()->can('update_vehicle_contact')) {
            $request['vehicle_id'] = $vehicleId;
            VehicleContactFacade::store($request->all());
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update vehicle contacts.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }

    /**
     * get
     *
     * @param  int $vehicleId
     * @return void
     */
    public function all(int $vehicleId)
    {
        $query = VehicleContactBook::query()->where('vehicle_id', $vehicleId)->orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name','designation','email','mobile_no','land_no')))
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

        // if (Auth::user()->can('delete_vehicle_contact')) {
            return VehicleContactFacade::delete($id);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to delete vehicle contacts.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }
}
