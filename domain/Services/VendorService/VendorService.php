<?php

namespace domain\Services\VendorService;

use App\Models\Vendors;

class VendorService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->vendor = new Vendors();
    }

    /**
     * All
     * retrieve all the data from Currency model
     *
     * @return void
     */
    public function all()
    {
        return $this->vendor->all();
    }

    /**
     * Store
     * store data in database
     *
     * @param  mixed $data
     * @return void
     */
    public function store(array $data)
    {
        return $this->vendor->create($data);
    }

    /**
     * Get
     * retrieve relevant data using vendor_id
     *      *
     * @param  mixed $vendor_id
     * @return void
     */
    public function get($vendor_id)
    {
        return $this->vendor->find($vendor_id);

    }

    /**
     * Update
     * update existing data using vendor_id
     *
     * @param  mixed $data
     * @param  mixed $vendor_id
     * @return void
     */
    public function update(array $data, $vendor_id)
    {
        $vendor = $this->vendor->find($vendor_id);
        return $vendor->update($this->edit($vendor, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  mixed $vendor
     * @param  mixed $data
     * @return void
     */
    protected function edit(vendors $vendor, $data)
    {
        return array_merge($vendor->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using vendor_id
     *
     * @param  mixed $vendor_id
     * @return void
     */
    public function delete($vendor_id)
    {
        return $this->vendor->find($vendor_id)->delete();
    }

    /**
     * deleteSelected
     *
     * @param  mixed $data
     * @return void
     */
    public function deleteSelected($data)
    {
        $ids = $data->input('ids');
        Vendors::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * inactive
     *
     * @param  mixed $data
     * @return void
     */
    public function inactive($data)
    {
        $ids = $data->input('ids');

        $vendors = Vendors::whereIn('id', $ids)->get();

        foreach ($vendors as $vendor) {
            $vendor->status = 0;
            $vendor->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }
    /**
     * active
     *
     * @param  mixed $data
     * @return void
     */
    public function active($data)
    {
        $ids = $data->input('ids');

        $vendors = Vendors::whereIn('id', $ids)->get();

        foreach ($vendors as $vendor) {
            $vendor->status = 1;
            $vendor->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

}
