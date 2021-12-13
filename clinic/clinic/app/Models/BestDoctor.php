<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestDoctor extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'id_doctor', 'created_at', 'updated_at'];


    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id');
    }

}
