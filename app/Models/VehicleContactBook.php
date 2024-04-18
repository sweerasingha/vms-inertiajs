<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleContactBook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'name',
        'designation',
        'email',
        'mobile_no',
        'land_no',
    ];

    /**
     * getAllContacts
     *
     * @param  int $vehicle_id
     * @return void
     */
    public function getAllContacts($vehicle_id)
    {
        return $this->where('vehicle_id', $vehicle_id)->get();
    }
}
