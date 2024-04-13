<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorTax extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'tax_name',
        'tax_type',
        'value',
    ];

    /**
     * getAllTaxes
     *
     * @param  int $vendor_id
     * @return void
     */
    public function getAllTaxes($vendor_id)
    {
        return $this->where('vendor_id', $vendor_id)->get();
    }
}
