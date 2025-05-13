<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 *
 * @property $id
 * @property $internal_id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $has_room_911_access
 * @property $department_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Department $department
 * @property AccessAttemp[] $accessAttemps
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Employee extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['internal_id', 'first_name', 'last_name', 'email', 'has_room_911_access', 'department_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessAttemps()
    {
        return $this->hasMany(AccessAttemp::class, 'employee_id');
    }
    
}
