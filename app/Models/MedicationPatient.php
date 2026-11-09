<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MedicationPatient extends Pivot
{
    protected $table = 'medication_patient';

    public $incrementing = true;

    protected $fillable = [
        'patient_id',
        'medication_id',
        'dosage',
        'frequency',
        'start_date',
        'end_date'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function medication(){
        return $this->belongsTo(Medication::class);
    }
}
