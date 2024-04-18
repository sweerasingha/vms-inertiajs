<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehiclePreviousOwners extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
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
     * @param  int $vehicle_id
     * @return void
     */
    public function getAllBankAccounts($vehicle_id)
    {
        return $this->where('vehicle_id', $vehicle_id)->get();
    }
}
