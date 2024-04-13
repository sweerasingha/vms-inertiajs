<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\ParentController;
use App\Http\Requests\Settings\MaterialCategory\CreateMaterialCategoryRequest;
use App\Http\Requests\Settings\MaterialCategory\UpdateMaterialCategoryRequest;
use domain\Facades\MaterialCategoryFacade\MaterialCategoryFacade;
use App\Models\MaterialCategory;
use App\Filters\FuzzyFilter;
use App\Http\Resources\DataResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MaterialCategoryController extends ParentController
{
    /**
     * Index
     *
     * @return void
     */
    public function index()
    {
        if (Auth::user()->can('read_categories')) {
            return Inertia::render('Settings/VehicleCategories/edit');
        } else {
            $response['alert-danger'] = 'You do not have permission to read material categories.';
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
        $query = MaterialCategory::orderBy('id', 'desc');
        $payload = QueryBuilder::for($query)
            ->allowedSorts(['code', 'name'])
            ->allowedFilters(AllowedFilter::custom('search', new FuzzyFilter('name', 'code')))
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return DataResource::collection($payload);
    }

    /**
     * allList
     *
     * @return void
     */
    public function allList()
    {
        return MaterialCategoryFacade::all();
    }

    /**
     * allLevel1
     *
     * @return void
     */
    public function allLevel1()
{
    try {
        return MaterialCategoryFacade::allLevel1();
    } catch (\Exception $e) {
        Log::error("Failed to fetch level 1 categories: " . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    /**
     * allLevel2
     *
     * @param  int $id
     * @return void
     */
    public function allLevel2(int $id)
    {
        return MaterialCategoryFacade::allLevel2($id);
    }

    /**
     * allLevel3
     *
     * @param  int $id
     * @return void
     */
    public function allLevel3(int $id)
    {
        return MaterialCategoryFacade::allLevel3($id);
    }

    /**
     * allLevel4
     *
     * @param  int $id
     * @return void
     */
    public function allLevel4(int $id)
    {
        return MaterialCategoryFacade::allLevel4($id);
    }

    /**
     * store
     *
     * @param  CreateMaterialCategoryRequest $request
     * @return void
     */
    public function store(CreateMaterialCategoryRequest $request)
    {
        if (Auth::user()->can('create_categories')) {
            return MaterialCategoryFacade::store($request->all());
        } else {
            $response['alert-danger'] = 'You do not have permission to create material categories.';
            return redirect()->route('materialCategory.index')->with($response);
        }
    }

    /**
     * delete
     *
     * @param  int $category_id
     * @return void
     */
    public function delete(int $category_id)
    {
        if (Auth::user()->can('delete_categories')) {
            return MaterialCategoryFacade::delete($category_id);
        } else {
            $response['alert-danger'] = 'You do not have permission to delete material categories.';
            return redirect()->route('materialCategory.index')->with($response);
        }
    }

    /**
     * get
     *
     * @param  int $material category Id
     * @return void
     */
    public function get(int $category_id)
    {
        $payload = MaterialCategoryFacade::get($category_id);
        return new DataResource($payload);
    }

    /**
     * update
     *
     * @param  UpdateMaterialCategoryRequest $request
     * @param  int $category_id
     * @return void
     */
    public function update(UpdateMaterialCategoryRequest $request, int $category_id)
    {
        if (Auth::user()->can('update_categories')) {
            return MaterialCategoryFacade::update($request->all(), $category_id);
        } else {
            $response['alert-danger'] = 'You do not have permission to update material categories.';
            return redirect()->route('materialCategory.index')->with($response);
        }
    }
}
