<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //

    protected $table = 'permissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'key',
        'group_name',
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
        'deleted_at' => 'datetime',
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
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }

    public static function generateFor($table_name)
    {
        self::firstOrCreate(['name' => 'display ' . $table_name,        'key' => 'display',         'group_name' => $table_name]);
        self::firstOrCreate(['name' => 'read ' . $table_name,           'key' => 'read',            'group_name' => $table_name]);
        self::firstOrCreate(['name' => 'edit ' . $table_name,           'key' => 'edit',            'group_name' => $table_name]);
        self::firstOrCreate(['name' => 'add ' . $table_name,            'key' => 'add',             'group_name' => $table_name]);
        self::firstOrCreate(['name' => 'delete ' . $table_name,         'key' => 'delete',          'group_name' => $table_name]);
        self::firstOrCreate(['name' => 'restore ' . $table_name,        'key' => 'restore',         'group_name' => $table_name]);
        self::firstOrCreate(['name' => 'force_delete ' . $table_name,   'key' => 'force_delete',    'group_name' => $table_name]);
    }

    public static function deleteFrom($table_name)
    {
        self::where('group_name', $table_name)->delete();
    }
}
