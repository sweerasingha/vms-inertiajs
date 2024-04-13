<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Vendors;
use App\Filters\FuzzyFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\ParentController;
use domain\Facades\VendorFacade\VendorFacade;
use App\Http\Requests\Vendors\CreateVendorRequest;
use App\Http\Requests\Vendors\UpdateVendorRequest;

class VendorsController extends ParentController
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('Vendors/index');

        // if (Auth::user()->can('read_vendor')) {
        //     return Inertia::render('Vendors/index');
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to read vendors.';
        //     return redirect()->route('dashboard')->with($response);
        // }

    }

    /**
     * store
     *
     * @param  CreateVendorRequest $request
     * @return void
     */
    public function store(CreateVendorRequest $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VendorFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create vendors.';
            return redirect()->route('vendors.index')->with($response);
        }

    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        $query = Vendors::orderBy('id', 'desc');
        if(request('search_vendor_code'))
        {
            $code = request('search_vendor_code');
            $query->where('code', $code);
        }
        if(request('search_vendor_name'))
        {
            $name = request('search_vendor_name');
            $query->where('name', 'like', "%{$name}%");
        }
        if(request('search_vendor_country'))
        {
            $country_id = request('search_vendor_country');
            $query->where('country_id', $country_id);
        }
        if(request('search_vendor_currency'))
        {
            $currency_id = request('search_vendor_currency');
            $query->where('currency_id', $currency_id);
        }
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['code'])
            ->allowedFilters(
                AllowedFilter::callback('search', function($query, $value){
                    $query->whereHas('countries', function(Builder $query) use ($value){
                        $query->where('name', 'like', "%{$value}%");
                    });
                    $query->orWhereHas('currencies', function(Builder $query) use ($value){
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
            return VendorFacade::delete($id);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete vendors.';
            return redirect()->route('vendors.index')->with($response);
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
            $response['vendor'] = VendorFacade::get($id);
            Log::info('Response:', $response);
            return Inertia::render('Vendors/edit', $response);
        } else {
            $response['alert-danger'] = 'You do not have permission to edit vendors.';
            return redirect()->route('vendors.index')->with($response);
        }

        // if (Auth::user()->can('view_vendor')) {
        //     $response['Vendor'] = VendorFacade::get($id);
        //     return Inertia::render('Vendors/edit', $response);
        // } else {
        //     $response['alert-danger'] = 'You do not have permission to edit vendors.';
        //     return redirect()->route('vendors.index')->with($response);
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
        $payload = VendorFacade::get($id);
        return new DataResource($payload);
    }

    /**
     * basicUpdate
     *
     * @param  UpdateVendorRequest $request
     * @param  int $id
     * @return void
     */
    public function basicUpdate(UpdateVendorRequest $request, int $id)
    {
        return VendorFacade::update($request->all(), $id);

    }

    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VendorFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive vendors.';
            return redirect()->route('vendors.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VendorFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active vendors.';
            return redirect()->route('vendors.index')->with($response);
        }
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return VendorFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete vendors.';
            return redirect()->route('vendors.index')->with($response);
        }

    }
}
