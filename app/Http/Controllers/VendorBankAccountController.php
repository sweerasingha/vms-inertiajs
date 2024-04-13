<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vendors\UpdateBankAccountRequest;
use domain\Facades\VendorBankFacade\VendorBankFacade;
use App\Models\VendorBankAccount;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Auth;

class VendorBankAccountController extends ParentController
{
    /**
     * update
     *
     * @param  UpdateBankAccountRequest $request
     * @param  int $vendorId
     * @return void
     */
    public function update(UpdateBankAccountRequest $request, int $vendorId)
    {

        // if (Auth::user()->can('update_vendor_bank')) {
            $request['vendor_id'] = $vendorId;
            VendorBankFacade::store($request->all());
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update Vendor bank details.';
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
        $query = VendorBankAccount::query()->where('vendor_id', $vendorId)->orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'bank_name', 'branch_name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('bank_name','bank_code','branch_name','branch_code','swift_code','account_no')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    /**
     * delete
     *
     * @param  int $vendorId
     * @return void
     */
    public function delete(int $vendorId)
    {

        // if (Auth::user()->can('delete_vendor_bank')) {
            return VendorBankFacade::delete($vendorId);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to delete Vendor bank details.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }
}
