<?php

namespace domain\Services\MaterialCategoryService;

use App\Models\MaterialCategory;

class MaterialCategoryService
{

    protected $category;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->category = new MaterialCategory();
    }

    /**
     * All
     * retrieve all the data from MaterialCategory model
     *
     * @return void
     */
    public function all()
    {
        return $this->category->all();
    }

    public function allLevel1()
    {
        return $this->category->where('level', 1)->with('children.children.children')->get();
    }


public function allLevel2(int $id)
{
    // Fetches all level 2 categories under a specific level 1 category
    return $this->category->where('parent_id', $id)->with('children.children')->get();
}

public function allLevel3(int $id)
{
    // Fetches all level 3 categories under a specific level 2 category
    return $this->category->where('parent_id', $id)->with('children')->get();
}

public function allLevel4(int $id)
{
    // Fetches all level 4 categories under a specific level 3 category
    return $this->category->where('parent_id', $id)->get();
}


    /**
     * Store
     * store data in database
     *
     * @param  array $data
     * @return void
     */
    public function store(array $data)
    {
        return $this->category->create($data);
    }

    /**
     * Get
     * retrieve relevant data using category_id
     *
     * @param  int  $category_id
     * @return void
     */
    public function get(int $category_id)
    {
        return $this->category->find($category_id);
    }

    /**
     * Update
     * update existing data using category_id
     *
     * @param  array $data
     * @param  int   $category_id
     * @return void
     */
    public function update(array $data, int $category_id)
    {
        $category = $this->category->find($category_id);
        return $category->update($this->edit($category, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  MaterialCategory $category
     * @param  array $data
     * @return void
     */
    protected function edit(MaterialCategory $category, array $data)
    {
        return array_merge($category->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using category_id
     *
     * @param  int  $category_id
     * @return void
     */
    public function delete(int $category_id)
    {
        $category = $this->category->find($category_id);
        $children1 = $category->children;
        if ($children1->count() > 0) {
            foreach ($children1 as $child1) {
                $children2 = $child1->children;
                if ($children2->count() > 0) {
                    foreach ($children2 as $child2) {
                        $children3 = $child2->children;
                        if ($children3->count() > 0) {
                            foreach ($children3 as $child3) {
                                $children4 = $child3->children;
                                if ($children4->count() > 0) {
                                    foreach ($children4 as $child4) {
                                        $children5 = $child4->children;
                                        $child4->delete();
                                    }
                                }
                                $child3->delete();
                            }
                        }
                        $child2->delete();
                    }
                }
                $child1->delete();
            }
        }
        return $category->delete();
    }
}
