<?php

namespace domain\Services\VendorContactService;

use App\Models\VendorContactBook;

class VendorContactService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->contact = new VendorContactBook();
    }

    /**
     * All
     * retrieve all the data from VendorContactBook model
     *
     * @return void
     */
    public function all()
    {
        return $this->contact->all();
    }

    /**
     * GetAllContacts
     * retrieve relevant data using vendor_id
     *
     * @param  mixed $vendor_id
     * @return void
     */
    public function getAllContacts($vendor_id)
    {
        return $this->contact->getAllContacts($vendor_id);
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
        return $this->contact->create($data);
    }

    /**
     * Get
     * retrieve relevant data using contact_id
     *
     * @param  int $contact_id
     * @return void
     */
    public function get(int $contact_id)
    {
        return $this->contact->find($contact_id);
    }

    /**
     * Update
     * update existing data using contact_id
     *
     * @param  array $data
     * @param  int   $contact_id
     * @return void
     */
    public function update(array $data, int $contact_id)
    {
        $contact = $this->contact->find($contact_id);
        return $contact->update($this->edit($contact, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  VendorContactBook $contact
     * @param  array             $data
     * @return void
     */
    protected function edit(VendorContactBook $contact, array $data)
    {
        return array_merge($contact->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using contact_id
     *
     * @param  int  $contact_id
     * @return void
     */
    public function delete(int $contact_id)
    {
        return $this->contact->find($contact_id)->delete();
    }
}
