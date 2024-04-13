<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendors extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'country_id',
        'currency_id',
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
        'currency_name',
    ];

    /**
     * vendorContact
     *
     * @return void
     */
    public function vendorContact()
    {
        return $this->hasOne(VendorContactBook::class, 'vendor_id', 'id');
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
     * currencies
     *
     * @return void
     */
    public function currencies()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    /**
     * vendorFinanceData
     *
     * @return void
     */
    public function vendorFinanceData()
    {
        return $this->hasOne(VendorFinanceRecord::class, 'vendor_id', 'id');
    }

    /**
     * vendors
     *
     * @return void
     */
    public function vendors()
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
     * getCurrencyNameAttribute
     *
     * @return void
     */
    public function getCurrencyNameAttribute()
    {
        return $this->currencies?$this->currencies->name:'N/A';
    }

    /**
     * getCurrencyCodeAttribute
     *
     * @return void
     */
    public function getCurrencyCodeAttribute()
    {
        return $this->currencies?$this->currencies->code:'N/A';
    }

}
