<?php

namespace domain\Services\CountryRegistryService;

use App\Models\Country;

class CountryRegistryService
{
    protected $country;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->country = new Country();
    }

    /**
     * All
     * retrieve all the data from Country model
     *
     * @return void
     */
    public function all()
    {
        return $this->country->all();
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
        return $this->country->create($data);
    }

    /**
     * Get
     * retrieve relevant data using country_id
     *
     * @param  int  $country_id
     * @return void
     */
    public function get(int $country_id)
    {
        return $this->country->find($country_id);
    }

    /**
     * Update
     * update existing data using country_id
     *
     * @param  array $data
     * @param  int   $country_id
     * @return void
     */
    public function update(array $data, int $country_id)
    {
        $country = $this->country->find($country_id);
        return $country->update($this->edit($country, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  country $country
     * @param  array $data
     * @return void
     */
    protected function edit(country $country, array $data)
    {
        return array_merge($country->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using country_id
     *
     * @param  int   $country_id
     * @return void
     */
    public function delete(int $country_id)
    {
        return $this->country->find($country_id)->delete();
    }

    /**
     * ChangeStatus
     * change status of the relevant data row using country_id
     *
     * @param  int  $country_id
     * @return void
     */
    public function deleteSelected($data)
    {
        $ids = $data->input('ids');
        Country::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function inactive($data)
    {
        $ids = $data->input('ids');

        $materials = Country::whereIn('id', $ids)->get();

        foreach ($materials as $material) {
            $material->status = 0;
            $material->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }
    public function active($data)
    {
        $ids = $data->input('ids');

        $materials = Country::whereIn('id', $ids)->get();

        foreach ($materials as $material) {
            $material->status = 1;
            $material->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
