<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorFinanceRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'payee_account_code',
        'gl_code',
        'tax_no',
        'vat_no',
        'incoterms',
        'credit_days',
        'payment_terms',
    ];

    /**
     * getAllFinance
     *
     * @param  int $vendor_id
     * @return void
     */
    public function getAllFinance($vendor_id)
    {
        return $this->where('vendor_id', $vendor_id)->get();
    }

    /**
     * getByFinanceId
     *
     * @param  int $vendor_id
     * @return void
     */
    public function getByFinanceId($vendor_id)
    {
        return $this->where('vendor_id', $vendor_id)->first();
    }
}
