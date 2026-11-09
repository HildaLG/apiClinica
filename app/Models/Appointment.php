<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';

    protected $fillable = [
        'patient_id',
        'appointment_date',
        'reason',
        'status',
        'notes'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
