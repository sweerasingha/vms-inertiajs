<?php
namespace domain\Services\VendorTaxService;

use App\Models\VendorTax;

class VendorTaxService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->tax = new VendorTax();
    }

    /**
     * All
     * retrieve all the data from VendorTax model
     *
     * @return void
     */
    public function all()
    {
        return $this->tax->all();
    }

    /**
     * GetAllPartners
     *
     * @param  int  $vendor_id
     * @return void
     */
    public function getAllTaxes(int $vendor_id)
    {
        return $this->tax->getAllTaxes($vendor_id);
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
        return $this->tax->create($data);
    }

    /**
     * Get
     * retrieve relevant data using tax_id
     *
     * @param  int $tax_id
     * @return void
     */
    public function get(int $tax_id)
    {
        return $this->tax->find($tax_id);
    }

    /**
     * Update
     * update existing data using tax_id
     *
     * @param  array $data
     * @param  int $tax_id
     * @return void
     */
    public function update(array $data, int $tax_id)
    {
        $tax = $this->tax->find($tax_id);
        return $tax->update($this->edit($tax, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  VendorTax $tax
     * @param  array             $data
     * @return void
     */
    protected function edit(VendorTax $tax, array $data)
    {
        return array_merge($tax->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using tax_id
     *
     * @param  int $tax_id
     * @return void
     */
    public function delete(int $tax_id)
    {
        return $this->tax->find($tax_id)->delete();
    }
}
