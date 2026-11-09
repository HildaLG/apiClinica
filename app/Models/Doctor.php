<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialty',
        'license_number'
    ];

    public function patients(){
        return $this->hasMany(Patient::class); //Un doctor tiene muchos pacientes
    }
}
