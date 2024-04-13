<?php

namespace domain\Services\VendorDataService;

use App\Models\MaterialVendor;
use App\Models\VendorData;

class VendorDataService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->vendorData = new VendorData();
        // $this->materialVendor = new MaterialVendor();
    }

    /**
     * UpdatePurchasing
     * update existing data using material_id
     *
     * @param  array $data
     * @param  int   $material_id
     * @return void
     */
    // public function updateVendor(array $data, int $material_id)
    // {
    //     $vendorData = $this->vendorData->getVendorData($material_id);
    //     if ($vendorData) {
    //         $data['uom'] = $data['unit_of_measure_id'];
    //         return $vendorData->update($this->edit($vendorData, $data));
    //     } else {
    //         $data['material_id'] = $material_id;
    //         $data['uom'] = $data['unit_of_measure_id'];
    //         return $this->vendorData->create($data);
    //     }
    // }

    /**
     * store
     *
     * @param  mixed $data
     * @return void
     */
    public function store(array $data)
    {
        return $this->vendorData->create($data);
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  mixed $purchasingData
     * @param  mixed $data
     * @return void
     */
    public function edit(VendorData $vendorData, $data)
    {
        return array_merge($vendorData->toArray(), $data);
    }

    /**
     * GetAllAssignedVendors
     * retrieve relevant data using materialId
     *
     * @param  int  $materialId
     * @return void
     */
    // public function getAllAssignedVendors(int $materialId)
    // {
    //     return $this->materialVendor->getAllAssignedVendors($materialId);
    // }

    /**
     * StoreAssignedVendors
     * store data in database
     *
     * @param  array $data
     * @return void
     */
    // public function storeAssignedVendors(array $data)
    // {
    //     $this->materialVendor->removeDefault($data['material_id']);
    //     // $defaultVendor = $this->materialVendor->getDefaultVendor($data['material_id']);
    //     // if(!$defaultVendor){
    //     //     $data['is_default'] = 1;
    //     // }
    //     $data['is_default'] = 1;
    //     $this->materialVendor->create($data);
    // }

    /**
     * DeleteAssignedVendor
     * delete specific data using id
     *
     * @param  int  $id
     * @return void
     */
    // public function deleteAssignedVendor(int $id)
    // {
    //     $vendor =  $this->materialVendor->find($id);
    //     $vendor->delete();
    // }

    public function getVendorData($materialId)
    {
        return $this->vendorData->getVendorData($materialId);
    }

    /**
     * Delete
     * delete specific data using vendor_id
     *
     * @param  int  $vendor_id
     * @return void
     */
    public function delete(int $vendor_id)
    {
        return $this->vendorData->find($vendor_id)->delete();
    }
}
