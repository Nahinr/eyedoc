<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = ['id'];

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
    
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'patient_id',
    ];
}
