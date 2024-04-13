<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorContactBook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'name',
        'designation',
        'email',
        'mobile_no',
        'land_no',
    ];

    /**
     * getAllContacts
     *
     * @param  int $vendor_id
     * @return void
     */
    public function getAllContacts($vendor_id)
    {
        return $this->where('vendor_id', $vendor_id)->get();
    }
}
