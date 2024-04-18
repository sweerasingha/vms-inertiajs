<?php

namespace domain\Services\VehicleService;

use App\Models\Vehicle;

class VehicleService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->vehicle = new Vehicle();
    }

    /**
     * All
     * retrieve all the data from vehicle category model
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
     * @param  mixed $data
     * @return void
     */
    public function store(array $data)
    {
        return $this->vehicle->create($data);
    }

    /**
     * Get
     * retrieve relevant data using vehicle_id
     *      *
     * @param  mixed $vehicle_id
     * @return void
     */
    public function get($vehicle_id)
    {
        return $this->vehicle->find($vehicle_id);

    }

    /**
     * Update
     * update existing data using vehicle_id
     *
     * @param  mixed $data
     * @param  mixed $vehicle_id
     * @return void
     */
    public function update(array $data, $vehicle_id)
    {
        $vehicle = $this->vehicle->find($vehicle_id);
        return $vehicle->update($this->edit($vehicle, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  mixed $vehicle
     * @param  mixed $data
     * @return void
     */
    protected function edit(vehicles $vehicle, $data)
    {
        return array_merge($vehicle->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using vehicle_id
     *
     * @param  mixed $vehicle_id
     * @return void
     */
    public function delete($vehicle_id)
    {
        return $this->vehicle->find($vehicle_id)->delete();
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
        Vehicle::whereIn('id', $ids)->delete();

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

        $vehicles = Vehicle::whereIn('id', $ids)->get();

        foreach ($vehicles as $vehicle) {
            $vehicle->status = 0;
            $vehicle->update();
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

        $vehicles = Vehicle::whereIn('id', $ids)->get();

        foreach ($vehicles as $vehicle) {
            $vehicle->status = 1;
            $vehicle->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

}
