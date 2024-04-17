<?php

namespace domain\Services\VehicleCategoryService;

use App\Models\VehicleCategory;

class VehicleCategoryService
{
    protected $vehicle;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->vehicle = new VehicleCategory();
    }

    /**
     * All
     * retrieve all the data from VehicleCategory model
     *
     * @return void
     */
    public function all()
    {
        return $this->vehicle->all();
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
        return $this->vehicle->create($data);
    }

    /**
     * Get
     * retrieve relevant data using vehicle_id
     *
     * @param  int  $vehicle_id
     * @return void
     */
    public function get(int $vehicle_id)
    {
        return $this->vehicle->find($vehicle_id);
    }

    /**
     * Update
     * update existing data using vehicle_id
     *
     * @param  array $data
     * @param  int   $vehicle_id
     * @return void
     */
    public function update(array $data, int $vehicle_id)
    {
        $vehicle = $this->vehicle->find($vehicle_id);
        return $vehicle->update($this->edit($vehicle, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  VehicleCategory $vehicle
     * @param  array $data
     * @return void
     */
    protected function edit(VehicleCategory $vehicle, array $data)
    {
        return array_merge($vehicle->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using vehicle_id
     *
     * @param  int  $vehicle_id
     * @return void
     */
    public function delete(int $vehicle_id)
    {
        return $this->vehicle->find($vehicle_id)->delete();
    }
    public function deleteSelected($data)
    {
        $ids = $data->input('ids');
        VehicleCategory::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function inactive($data)
    {
        $ids = $data->input('ids');

        $materials = VehicleCategory::whereIn('id', $ids)->get();

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

        $materials = VehicleCategory::whereIn('id', $ids)->get();

        foreach ($materials as $material) {
            $material->status = 1;
            $material->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function changeStatus(int $vehicle_id)
    {
        $vehicle = $this->vehicle->find($vehicle_id);
        if (!$vehicle) {
            return response()->json(['error' => 'vehicle not found'], 404);
        }

        // Toggle status for example, or set based on some condition or input
        $vehicle->status = $vehicle->status == 1 ? 0 : 1;
        $vehicle->save();
https://www.duino.lk/product-category/sensors/proximity-sensors/
        return response()->json([
            'success' => true,
            'message' => 'Status changed successfully',
            'status' => $vehicle->status
        ]);
    }
}
