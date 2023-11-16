<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function appointments(){
        return $this->hasMany('App\Models\Appointment');
    }
    use HasFactory;
}