<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vendors\UpdateFinanceRecordRequest;
use domain\Facades\VendorFinanceFacade\VendorFinanceFacade;
use domain\Facades\VendorFacade\VendorFacade;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use App\Models\VendorFinanceRecord;
use Illuminate\Support\Facades\Auth;

class VendorFinanceRecordController extends ParentController
{
    /**
     * update
     *
     * @param  UpdateFinanceRecordRequest $request
     * @param  int $vendor_id
     * @return void
     */
    public function update(UpdateFinanceRecordRequest $request, int $vendor_id)
    {

        // if (Auth::user()->can('update_vendor_finance')) {
            VendorFinanceFacade::updateFinance($request->all(), $vendor_id);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update Vendor finances.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }

    /**
     * get
     *
     * @param  int  $vendor_id
     * @return void
     */
    public function get(int $vendor_id)
    {
        $vendor = VendorFacade::get($vendor_id);
        return $vendor->vendorFinanceData ? $vendor->vendorFinanceData : null;
    }
}
