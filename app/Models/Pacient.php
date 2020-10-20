<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visit;
use App\Models\Treatment;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\Payment;
use App\Models\Debt;

class Pacient extends Model
{
    use HasFactory;


    public function visit()
    {
        return $this->hasMany(Visit::class);
    }

    public function treatment()
    {
        return $this->hasMany(Treatment::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function report()
    {
        return $this->hasMany(Report::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function debt()
    {
        return $this->hasMany(Debt::class);
    }

    public static function getPacient($id)
    {
        $pacient = Pacient::find($id);
        return $pacient->first_name . ' ' . $pacient->last_name . ' ' . $pacient->personal_number;
    }

    public static function getPacientName($id)
    {
        $pacient = Pacient::find($id);
        return $pacient->first_name . ' ' . $pacient->last_name;
    }

    public static function getPacientID($id)
    {
        $pacient = Pacient::find($id);
        return '' . $pacient->personal_number;
    }
}
