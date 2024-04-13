<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\ParentController;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filters\FuzzyFilter;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Currency;
use domain\Facades\CurrencyRegistryFacade\CurrencyRegistryFacade;
use App\Http\Requests\Currency\CreateCurrencyRequest;
use App\Http\Requests\Currency\AddBasicCurrencyRequest;
use App\Http\Requests\Currency\UpdateCurrencyRequest;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends ParentController
{
    /**
     * index
     * Load currency section
     *
     * @return void
     */
    public function index()
    {
        if (Auth::user()->can('add_permissions')) {
            return Inertia::render('Settings/Currency/all');
        } else {
            $response['alert-danger'] = 'You do not have permission to read currencies.';
            return redirect()->route('dashboard')->with($response);
        }

    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        $query = Currency::where('code', '!=' , 'BC000001')->orderBy('id','desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name','code','rate')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    /**
     * store
     *
     * @param  CreateCurrencyRequest $request
     * @return void
     */
    public function store(CreateCurrencyRequest $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CurrencyRegistryFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create currencies.';
            return redirect()->route('currency.index')->with($response);
        }

    }

    /**
     * baseCurrencyStore
     * To Store base currency for the system
     *
     * @param  mixed $request
     * @return void
     */
    public function baseCurrencyStore(AddBasicCurrencyRequest $request)
    {
        $request['code'] = 'BC000001';
        $request['name'] = 'Base Currency';
        return CurrencyRegistryFacade::baseCurrencyStore($request->all());
    }

    /**
     * getBaseCurrency
     * Get stored base currency
     *
     * @return void
     */
    public function getBaseCurrency()
    {
        $base_currency_row =  CurrencyRegistryFacade::getBaseCurrency();
        if($base_currency_row->base_currency_id!==null){
            return CurrencyRegistryFacade::get($base_currency_row->base_currency_id);
        }else{
            return null;
        }
    }

    /**
     * delete
     *
     * @param  mixed $currencyId
     * @return void
     */
    public function delete(int $currencyId)
    {
        if (Auth::user()->can('add_permissions')) {
            return CurrencyRegistryFacade::delete($currencyId);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete currencies.';
            return redirect()->route('currency.index')->with($response);
        }
    }

    /**
     * update
     *
     * @param  CreateCurrencyRequest $request
     * @param  mixed $currencyId
     * @return void
     */
    public function update(UpdateCurrencyRequest $request, int $currencyId)
    {
        if (Auth::user()->can('add_permissions')) {
            return CurrencyRegistryFacade::update($request->all(),$currencyId);
        } else {
            $response['alert-danger'] = 'You do not have permission to update currencies.';
            return redirect()->route('currency.index')->with($response);
        }

    }

    /**
     * get
     *
     * @param  mixed $currencyId
     * @return void
     */
    public function get(int $currencyId)
    {
        $payload = CurrencyRegistryFacade::get($currencyId);
        return new DataResource($payload);
    }

    public function deleteSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CurrencyRegistryFacade::deleteSelected($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete currencies.';
            return redirect()->route('currency.index')->with($response);
        }
    }

    public function inactiveSelectedItems(Request $request)
    {
        if (Auth::user()->can('add_permissions')) {
            return CurrencyRegistryFacade::inactive($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to inactive currencies.';
            return redirect()->route('currency.index')->with($response);
        }
    }
    public function activeSelectedItems(Request $request)
    {

        if (Auth::user()->can('add_permissions')) {
            return CurrencyRegistryFacade::active($request);
        } else {
            $response['alert-danger'] = 'You do not have permission to active currencies.';
            return redirect()->route('currency.index')->with($response);
        }
    }
}
