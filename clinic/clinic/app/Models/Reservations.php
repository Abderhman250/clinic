<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = ['dr_id', 'status', 'start','end','date','created_at', 'updated_at'];


    public function Doctor()
    {
        return $this->belongsTo('App\Models\User', 'dr_id');
    }
}
