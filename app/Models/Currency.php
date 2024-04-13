<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'rate',
        'status',

        'base_currency_id',
    ];

    protected $appends = [
        'formate_rate',
    ];

    /**
     * getActive
     *
     * @return void
     */
    public function getActive()
    {
        return $this->where('status', 1)->get();
    }

    /**
     * getFormateRateAttribute
     *
     * @return void
     */
    public function getFormateRateAttribute()
    {
        $rate = $this->rate;
        return number_format($rate, 2);
    }

    /**
     * getBaseCurrency
     *
     * @return void
     */
    public function getBaseCurrency(){
        return $this->where('code', 'BC000001')->first();
    }

    /**
     * getDollerRate
     *
     * @return void
     */
    public function getDollerRate(){
        return $this->where('code', 'USD')->first();
    }
}
