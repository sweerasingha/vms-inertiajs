<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vendors\UpdatePartnerAccountRequest;
use domain\Facades\VendorPartnerFacade\VendorPartnerFacade;
use App\Models\VendorPartnerAccount;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Auth;

class VendorPartnerAccountController extends ParentController
{
    /**
     * update
     *
     * @param  UpdatePartnerAccountRequest $request
     * @param  int $vendorId
     * @return void
     */
    public function update(UpdatePartnerAccountRequest $request, int $vendorId)
    {

        // if (Auth::user()->can('update_vendor')) {
            $request['vendor_id'] = $vendorId;
            VendorPartnerFacade::store($request->all());
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update vendor partner accounts.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }

    /**
     * all
     *
     * @param  int $vendorId
     * @return void
     */
    public function all(int $vendorId)
    {
        $query = VendorPartnerAccount::query()->where('vendor_id', $vendorId)->orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name','type','address_line_1','address_line_2','contact_1','contact_2','fax','web_site')))
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

        // if (Auth::user()->can('delete_vendor_partner')) {
            return VendorPartnerFacade::delete($id);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to delete vendor partner accounts.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }
}
