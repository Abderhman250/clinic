<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property int $quantity
 * @property float $price
 * @property string $image
 * @property string $cretaed_at
 * @property string $updated_at
 * @property User $user
 */
class Medicine extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'medicines';
    // public $timestamps = true;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description', 'quantity', 'price','image'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
