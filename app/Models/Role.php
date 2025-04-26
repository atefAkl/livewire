<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'brief',
        'key',
        'color',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    public $timestamps = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    /**
     * The permissions that belong to the role.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    /**
     * Check if the role has the given permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->permissions()->where('key', $permission)->exists();
    }

    /**
     * Check if the role has any of the given permissions.
     *
     * @param  array<string>  $permissions
     * @return bool
     */
    public function hasAnyPermission($permissions)
    {
        return $this->permissions()->whereIn('key', $permissions)->exists();
    }

    /**
     * look for useres .
     *
     * @param  array<string>  $permissions
     * @return bool
     */

    public function userTrashed()
    {
        return $this->hasMany(User::class)->onlyTrashed();
    }
}
