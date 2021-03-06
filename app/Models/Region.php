<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


/**
 * @property int $id
 * @property string $name
 * @property int $region_manager_id
 * @property int $department_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $regionManager
 * @property-read Department $department
 */
class Region extends Model
{
    public function regionManger()
    {
        return $this->belongsTo(User::class, 'region_manager_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'foreign_key', 'user_id')->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    public function scopeSearch(Builder $query, $search)
    {
        $query->when($search, function (Builder $query) use ($search) {
            $query->where(
                DB::raw('lower(regions.name)'),
                'like',
                '%' . strtolower($search) . '%'
            );
        });
    }
}
