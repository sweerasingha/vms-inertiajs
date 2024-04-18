<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vehicle\UpdateBankAccountRequest;
use domain\Facades\VehicleBankFacade\VehicleBankFacade;
use App\Models\VehiclePreviousOwners;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Auth;

class VehiclePreviousOwnerController extends ParentController
{
    /**
     * update
     *
     * @param  UpdateBankAccountRequest $request
     * @param  int $vehicleId
     * @return void
     */
    public function update(UpdateBankAccountRequest $request, int $vehicleId)
    {

        // if (Auth::user()->can('update_vendor_bank')) {
            $request['vehicle_id'] = $vehicleId;
            VehicleBankFacade::store($request->all());
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update Vendor bank details.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }

    /**
     * all
     *
     * @param  int $vehicleId
     * @return void
     */
    public function all(int $vehicleId)
    {
        $query = VehiclePreviousOwners::query()->where('vehicle_id', $vehicleId)->orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'bank_name', 'branch_name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('bank_name','bank_code','branch_name','branch_code','swift_code','account_no')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    /**
     * delete
     *
     * @param  int $vehicleId
     * @return void
     */
    public function delete(int $vehicleId)
    {

        // if (Auth::user()->can('delete_vendor_bank')) {
            return VehicleBankFacade::delete($vehicleId);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to delete Vendor bank details.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }
}
