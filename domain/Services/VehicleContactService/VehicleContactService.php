<?php

namespace domain\Services\VehicleContactService;

use App\Models\VehicleContactBook;

class VehicleContactService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->contact = new VehicleContactBook();
    }

    /**
     * All
     * retrieve all the data from VehicleContactBook model
     *
     * @return void
     */
    public function all()
    {
        return $this->contact->all();
    }

    /**
     * GetAllContacts
     * retrieve relevant data using vehicle_id
     *
     * @param  mixed $vehicle_id
     * @return void
     */
    public function getAllContacts($vehicle_id)
    {
        return $this->contact->getAllContacts($vehicle_id);
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
     * @param  VehicleContactBook $contact
     * @param  array             $data
     * @return void
     */
    protected function edit(VehicleContactBook $contact, array $data)
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
