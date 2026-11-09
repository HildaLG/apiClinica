<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'doctor_id',
        'name',
        'email',
        'phone',
        'birthdate',
        'gender',
        'address'
    ];


    public function doctor(){
        return $this->belongsTo(Doctor::class); //Este paciente pertence a un doctor
    }

    public function appointments(){
        return $this->hasMany(Appointment::class); //Este paciente puede tener muchas citas
    }

    public function medications(){
        return $this->belongsToMany(Medication::class, 'medication_patient')
            ->using(MedicationPatient::class)
            ->withPivot('id', 'dosage', 'frequency', 'start_date', 'end_date')
            ->withTimestamps();
    }

    public function prescriptions(){
        return $this->hasMany(MedicationPatient::class);
    }
}
