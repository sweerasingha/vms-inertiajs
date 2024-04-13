<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'status', // NOT USED
        // 'parent_id',
        // 'level',
    ];

    protected $appends = [
        'full_name',
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
     * allLevel1
     *
     * @return void
     */
    public function allLevel1()
    {
        return $this->where('level', 1)->get();
    }

    /**
     * allLevel2
     *
     * @param  int $id
     * @return void
     */
    public function allLevel2(int $id )
    {
        return $this->where('parent_id', $id)->where('level', 2)->get();
    }

    /**
     * allLevel3
     *
     * @param  int $id
     * @return void
     */
    public function allLevel3(int $id )
    {
        return $this->where('parent_id', $id)->where('level', 3)->get();
    }

    /**
     * allLevel4
     *
     * @param  int $id
     * @return void
     */
    public function allLevel4(int $id )
    {
        return $this->where('parent_id', $id)->where('level', 4)->get();
    }

    /**
     * children
     *
     * @return void
     */
    public function children()
    {
        return $this->hasMany(MaterialCategory::class, 'parent_id', 'id');
        // dd($childres);
    }

    /**
     * parent
     *
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo(MaterialCategory::class, 'parent_id', 'id');
    }

    /**
     * getFullNameAttribute
     *
     * @return void
     */
    public function getFullNameAttribute()
    {
        $name = $this->name;
        $parent = $this->parent;
        while ($parent) {
            $name = $parent->name . ' - ' . $name;
            $parent = $parent->parent;
        }
        return $name;
    }
}
