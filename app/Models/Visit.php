<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Treatment;
use App\Models\User;
use App\Models\Patient;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','user_id','date_of_visit','time_of_visit'];

    public function treatment()
    {
        return $this->hasOne(Treatment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public static function getVisitPatientName($id)
    {
        $visit = Visit::find($id);
        $patient = Patient::find($visit->patient_id);
        return $patient->name;
    }
}
