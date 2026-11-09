<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
        'name',
        'description',
        'presentation',
        'price'
    ];

    public function patients(){
        return $this->belongsToMany(Patient::class, 'medication_patient')
            ->using(MedicationPatient::class)
            ->withPivot('id', 'dosage', 'frequency', 'start_date', 'end_date')
            ->withTimestamps();
    }
}
