<?php

namespace domain\Services\VendorBankService;

use App\Models\VendorBankAccount;

class VendorBankService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->bank_accounts = new VendorBankAccount();
    }

    /**
     * All
     * retrieve all the data from VendorBankAccount model
     *
     * @return void
     */
    public function all()
    {
        return $this->bank_accounts->all();
    }

    /**
     * GetAllBankAccounts
     * retrieve relevant data using vendor_id
     *
     * @param  int  $vendor_id
     * @return void
     */
    public function getAllBankAccounts(int $vendor_id)
    {
        return $this->bank_accounts->getAllBankAccounts($vendor_id);
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
        return $this->bank_accounts->create($data);
    }

    /**
     * Get
     * retrieve relevant data using bank_account_id
     *
     * @param  int $bank_account_id
     * @return void
     */
    public function get(int $bank_account_id)
    {
        return $this->bank_accounts->find($bank_account_id);
    }

    /**
     * Update
     * update existing data using bank_account_id
     *
     * @param  array $data
     * @param  int $bank_account_id
     * @return void
     */
    public function update(array $data, int $bank_account_id)
    {
        $bank_accounts = $this->bank_accounts->find($bank_account_id);
        return $bank_accounts->update($this->edit($bank_accounts, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  VendorBankAccount   $bank_accounts
     * @param  array                   $data
     * @return void
     */
    protected function edit(VendorBankAccount $bank_accounts, $data)
    {
        return array_merge($bank_accounts->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using bank_account_id
     *
     * @param  int  $bank_account_id
     * @return void
     */
    public function delete(int $bank_account_id)
    {
        return $this->bank_accounts->find($bank_account_id)->delete();
    }
}
