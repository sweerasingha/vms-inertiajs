<?php
namespace domain\Services\VendorPartnerService;

use App\Models\VendorPartnerAccount;

class VendorPartnerService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->partner = new VendorPartnerAccount();
    }

    /**
     * All
     * retrieve all the data from VendorPartnerAccount model
     *
     * @return void
     */
    public function all()
    {
        return $this->partner->all();
    }

    /**
     * GetAllPartners
     *
     * @param  int  $vendor_id
     * @return void
     */
    public function getAllPartners(int $vendor_id)
    {
        return $this->partner->getAllPartners($vendor_id);
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
        return $this->partner->create($data);
    }

    /**
     * Get
     * retrieve relevant data using partner_id
     *
     * @param  int $partner_id
     * @return void
     */
    public function get(int $partner_id)
    {
        return $this->partner->find($partner_id);
    }

    /**
     * Update
     * update existing data using partner_id
     *
     * @param  array $data
     * @param  int $partner_id
     * @return void
     */
    public function update(array $data, int $partner_id)
    {
        $partner = $this->partner->find($partner_id);
        return $partner->update($this->edit($partner, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  VendorPartnerAccount $partner
     * @param  array             $data
     * @return void
     */
    protected function edit(VendorPartnerAccount $partner, array $data)
    {
        return array_merge($partner->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using partner_id
     *
     * @param  int $partner_id
     * @return void
     */
    public function delete(int $partner_id)
    {
        return $this->partner->find($partner_id)->delete();
    }
}
