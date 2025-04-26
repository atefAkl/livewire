<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //

    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'code',
        'iso3',
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

    /**
     * Get the cities associated with the country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    /**
     * Get the users associated with the country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'country_id', 'id');
    }

    /**
     * Get the user who created the country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the user who last updated the country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Get the uppercase value of the 'code' attribute.
     *
     * @param string $value
     * @return string
     */
    public function getCodeAtAttribute($value)
    {
        return $this->attributes['code'] = strtoupper($value);
    }

    /**
     * Get the uppercase value of the 'iso3' attribute.
     *
     * @param string $value
     * @return string
     */
    public function getIso3AtAttribute($value)
    {
        return $this->attributes['iso3'] = strtoupper($value);
    }
}
