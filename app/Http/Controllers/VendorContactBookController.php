<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vendors\UpdateContactBookRequest;
use domain\Facades\VendorContactFacade\VendorContactFacade;
use App\Models\VendorContactBook;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Auth;

class VendorContactBookController extends ParentController
{
    /**
     * update
     *
     * @param  UpdateContactBookRequest $request
     * @param  int $vendorId
     * @return void
     */
    public function update(UpdateContactBookRequest $request, int $vendorId)
    {

        // if (Auth::user()->can('update_vendor_contact')) {
            $request['vendor_id'] = $vendorId;
            VendorContactFacade::store($request->all());
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update Vendor contacts.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }

    /**
     * get
     *
     * @param  int $vendorId
     * @return void
     */
    public function all(int $vendorId)
    {
        $query = VendorContactBook::query()->where('vendor_id', $vendorId)->orderBy('id','desc');
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

        // if (Auth::user()->can('delete_vendor_contact')) {
            return VendorContactFacade::delete($id);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to delete Vendor contacts.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }
}
