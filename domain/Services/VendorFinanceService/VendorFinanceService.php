<?php

namespace domain\Services\VendorFinanceService;

use App\Models\VendorFinanceRecord;

class VendorFinanceService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->finance = new VendorFinanceRecord();
    }

    /**
     * All
     * retrieve all the data from VendorFinanceRecord model
     *
     * @return void
     */
    public function all()
    {
        return $this->finance->all();
    }

    /**
     * GetAllFinance
     * retrieve relevant data using vendor_id
     *
     * @param  int  $vendor_id
     * @return void
     */
    public function getAllFinance(int $vendor_id)
    {
        return $this->finance->getAllFinance($vendor_id);
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
        return $this->finance->create($data);
    }

    /**
     * Get
     * retrieve relevant data using finance_id
     *
     * @param  int  $finance_id
     * @return void
     */
    public function get(int $finance_id)
    {
        return $this->finance->find($finance_id);
    }

    /**
     * Edit
     * merge data which retrieved from updateFinance function as an array
     *
     * @param  VendorFinanceRecord $finance
     * @param  array             $data
     * @return void
     */
    protected function edit(VendorFinanceRecord $finance, array $data)
    {
        return array_merge($finance->toArray(), $data);
    }

    /**
     * UpdateFinance
     * update existing data using vendor_id
     *
     * @param  array $data
     * @param  int   $vendor_id
     * @return void
     */
    public function updateFinance(array $data, int $vendor_id)
    {
        $vendorFinanceData = $this->finance->getByFinanceId($vendor_id);
        if($vendorFinanceData){
            return $vendorFinanceData->update($this->edit($vendorFinanceData,$data));
        }else{
            $data['vendor_id'] = $vendor_id;
            return $this->finance->create($data);
        }
    }

    /**
     * Delete
     * delete specific data using finance_id
     *
     * @param  int  $finance_id
     * @return void
     */
    public function delete(int $finance_id)
    {
        return $this->finance->find($finance_id)->delete();
    }
}
