<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorBankAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'bank_name',
        'bank_code',
        'branch_name',
        'branch_code',
        'swift_code',
        'account_no',
    ];

    /**
     * getAllBankAccounts
     *
     * @param  int $vendor_id
     * @return void
     */
    public function getAllBankAccounts($vendor_id)
    {
        return $this->where('vendor_id', $vendor_id)->get();
    }
}
