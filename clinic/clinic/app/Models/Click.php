<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $click
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Click extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'clicks';
 
    /**
     * 
     * @var array
     * 
     */
    protected $fillable = ['user_id', 'click', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id');
    }
}
