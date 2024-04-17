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
     * @param  Country $country
     * @param  array $data
     * @return void
     */
    protected function edit(Country $country, array $data)
    {
        return array_merge($country->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using country_id
     *
     * @param  int  $country_id
     * @return void
     */
    public function delete(int $country_id)
    {
        return $this->country->find($country_id)->delete();
    }
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

        $countries = Country::whereIn('id', $ids)->get();

        foreach ($countries as $country) {
            $country->status = 0;
            $country->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }
    public function active($data)
    {
        $ids = $data->input('ids');

        $countries = Country::whereIn('id', $ids)->get();

        foreach ($countries as $country) {
            $country->status = 1;
            $country->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function changeStatus(int $country_id)
    {
        $country = $this->country->find($country_id);
        if (!$country) {
            return response()->json(['error' => 'country not found'], 404);
        }

        // Toggle status for example, or set based on some condition or input
        $country->status = $country->status == 1 ? 0 : 1;
        $country->save();
https://www.duino.lk/product-category/sensors/proximity-sensors/
        return response()->json([
            'success' => true,
            'message' => 'Status changed successfully',
            'status' => $country->status
        ]);
    }
}
