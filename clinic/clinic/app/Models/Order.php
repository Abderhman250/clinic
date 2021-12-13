<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $pharmacy_id
 * @property int $medicine_id
 * @property string $created_at
 * @property string $updated_at
 * @property Medicine $medicine
 * @property User $user
 * @property User $user
 */
class Order extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'pharmacy_id', 'medicine_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine' , 'medicine_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pharmacy()
    {
        return $this->belongsTo('App\Models\User', 'pharmacy_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id');
    }
}
