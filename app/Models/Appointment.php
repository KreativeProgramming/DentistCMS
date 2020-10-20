<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pacient;


class Appointment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pacient()
    {
        return $this->belongsTo(Pacient::class);
    }

    public static function getAppointmentByTimeAndDate($time, $date)
    {
        $newdate = date('Y-m-d', strtotime($date));
        $appointment = Appointment::where([
            ['time_of_appointment', '=', $time],
            ['date_of_appointment', '=', $newdate],
        ])->first();
        if ($appointment == null)
            return "-";
        return Pacient::getPacientName($appointment->pacient_id);
    }

    public static function getAppointmentNumberToday($date)
    {
        $appointment = Appointment::where('date_of_appointment', '=', $date)->get();
        return count($appointment);
    }
}
