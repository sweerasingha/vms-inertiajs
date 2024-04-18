<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'country_id',
        'vehicle_category_id',
        'name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'contact_1',
        'contact_2',
        'fax',
        'brc_no',
        'nic_no',
        'web_site',
    ];

    protected $appends = [
        'country_name',
        'vehicle_category_name',
    ];

    /**
     * vehicleContact
     *
     * @return void
     */
    public function vehicleContact()
    {
        return $this->hasOne(VehicleContactBook::class, 'vehicle_id', 'id');
    }

    /**
     * countries
     *
     * @return void
     */
    public function countries()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * vehicle categories
     *
     * @return void
     */
    public function vehiclecategories()
    {
        return $this->hasOne(VehicleCategory::class, 'id', 'vehicle_category_id');
    }

    // /**
    //  * currencies
    //  *
    //  * @return void
    //  */
    // public function currencies()
    // {
    //     return $this->hasOne(Currency::class, 'id', 'currency_id');
    // }

    // /**
    //  * vendorFinanceData
    //  *
    //  * @return void
    //  */
    // public function vendorFinanceData()
    // {
    //     return $this->hasOne(VendorFinanceRecord::class, 'vehicle_id', 'id');
    // }

    /**
     * vehicles
     *
     * @return void
     */
    public function vehicles()
    {
        return $this->get();
    }

    /**
     * getCountryNameAttribute
     *
     * @return void
     */
    public function getCountryNameAttribute()
    {
        return $this->countries?$this->countries->name:'N/A';
    }

    /**
     * getVehicleCategoryNameAttribute
     *
     * @return void
     */
    public function getVehicleCategoryNameAttribute()
    {
        return $this->vehiclecategories?$this->vehiclecategories->name:'N/A';
    }

    // /**
    //  * getCurrencyNameAttribute
    //  *
    //  * @return void
    //  */
    // public function getCurrencyNameAttribute()
    // {
    //     return $this->currencies?$this->currencies->name:'N/A';
    // }

    /**
     * getCountryCodeAttribute
     *
     * @return void
     */
    public function getCountryCodeAttribute()
    {
        return $this->countries?$this->countries->code:'N/A';
    }

    // /**
    //  * getCurrencyCodeAttribute
    //  *
    //  * @return void
    //  */
    // public function getCurrencyCodeAttribute()
    // {
    //     return $this->currencies?$this->currencies->code:'N/A';
    // }

}
