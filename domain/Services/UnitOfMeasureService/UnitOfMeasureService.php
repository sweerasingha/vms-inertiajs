<?php

namespace domain\Services\UnitOfMeasureService;

/**
 * UnitOfMeasureService
 * php version 8
 *
 * @category Service
 * @author   CyberElysium <contact@cyberelysium.com>
 * @license  https://cyberelysium.com Config
 * @link     https://cyberelysium.com
 * */
use App\Models\UnitOfMeasure;

class UnitOfMeasureService
{
    protected $unit;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->unit = new UnitOfMeasure();
    }

    /**
     * All
     * retrieve all the data from UnitOfMeasure model
     *
     * @return void
     */
    public function all()
    {
        return $this->unit->all();
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
        return $this->unit->create($data);
    }

    /**
     * Get
     * retrieve relevant data using unit_id
     *
     * @param  int  $unit_id
     * @return void
     */
    public function get(int $unit_id)
    {
        return $this->unit->find($unit_id);
    }

    /**
     * Update
     * update existing data using unit_id
     *
     * @param  array $data
     * @param  int   $unit_id
     * @return void
     */
    public function update(array $data, int $unit_id)
    {
        $unit = $this->unit->find($unit_id);
        return $unit->update($this->edit($unit, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  UnitOfMeasure $unit
     * @param  array $data
     * @return void
     */
    protected function edit(UnitOfMeasure $unit, array $data)
    {
        return array_merge($unit->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using unit_id
     *
     * @param  int  $unit_id
     * @return void
     */
    public function delete(int $unit_id)
    {
        return $this->unit->find($unit_id)->delete();
    }
    public function deleteSelected($data)
    {
        $ids = $data->input('ids');
        UnitOfMeasure::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function inactive($data)
    {
        $ids = $data->input('ids');

        $materials = UnitOfMeasure::whereIn('id', $ids)->get();

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

        $materials = UnitOfMeasure::whereIn('id', $ids)->get();

        foreach ($materials as $material) {
            $material->status = 1;
            $material->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function changeStatus(int $unit_id)
{
    $unit = $this->unit->find($unit_id);
    if (!$unit) {
        return response()->json(['error' => 'Unit not found'], 404);
    }

    // Toggle status for example, or set based on some condition or input
    $unit->status = $unit->status == 1 ? 0 : 1;
    $unit->save();

    return response()->json([
        'success' => true,
        'message' => 'Status changed successfully',
        'status' => $unit->status
    ]);
}

}
