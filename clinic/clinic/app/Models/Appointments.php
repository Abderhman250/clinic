<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'reservations_id', 'status','created_at', 'updated_at'];


    public function User()
    {
        return $this->belongsTo('App\Models\User', 'dr_id');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservations', 'reservations_id');
    }
}
