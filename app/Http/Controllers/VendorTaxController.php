<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Vendors\UpdateTaxRequest;
use domain\Facades\VendorTaxFacade\VendorTaxFacade;
use App\Models\VendorTax;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Auth;

class VendorTaxController extends ParentController
{
    /**
     * update
     *
     * @param  UpdateTaxRequest $request
     * @param  int $vendorId
     * @return void
     */
    public function update(UpdateTaxRequest $request, int $vendorId)
    {

        // if (Auth::user()->can('update_vendor_tax')) {
            $request['vendor_id'] = $vendorId;
            VendorTaxFacade::store($request->all());
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to update vendor taxes.';
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
        $query = VendorTax::query()->where('vendor_id', $vendorId)->orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('tax_name','tax_type','value')))
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

        // if (Auth::user()->can('delete_vendor_tax')) {
            return VendorTaxFacade::delete($id);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to delete vendor taxes.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }
}
