<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorPartnerAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'type',
        'name',
        'address_line_1',
        'address_line_2',
        'contact_1',
        'contact_2',
        'fax',
        'web_site',
    ];

    /**
     * getAllPartners
     *
     * @param  int $vendor_id
     * @return void
     */
    public function getAllPartners($vendor_id)
    {
        return $this->where('vendor_id', $vendor_id)->get();
    }
}
