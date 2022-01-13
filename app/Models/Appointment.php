<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Eloquent\SoftDeletes;


class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['patient_id','user_id','date_of_appointment','time_of_appointment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
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
        return Patient::getPatientName($appointment->patient_id);
    }

    public static function getAppointmentNumberToday($date)
    {
        $appointment = Appointment::where('date_of_appointment', '=', $date)->get();
        return count($appointment);
    }

    public function scopeOrderByDate($query)
    {
        $query->orderBy('date_of_appointment','desc');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('date_of_appointment', 'like', '%'.$search.'%')
                    ->orWhere('time_of_appointment', 'like', '%'.$search.'%')
                    ->orWhereHas('patient', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
