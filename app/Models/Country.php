<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'status',
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
}
