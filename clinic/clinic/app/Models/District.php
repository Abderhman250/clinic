<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property City $city
 * @property User[] $users
 */
class District extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'districts';

    /**
     * @var array
     */
    protected $fillable = ['city_id', 'name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City' , 'city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
