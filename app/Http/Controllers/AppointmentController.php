<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\User;
use App\Models\Patient;

class AppointmentController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-appointment'))
            return response(__('messages.noauthorization'), 403);
        else
            return Appointment::with(['patient', 'user'])->get();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-appointment'))
            return response(__('messages.noauthorization'), 403);
        else {
            if(Appointment::where('date_of_appointment','=',Request::get('date_of_appointment'))->where('time_of_appointment','=',Request::get('time_of_appointment'))->where('user_id','=',Request::get('user_id'))->count()  > 0)
            {
                    throw ValidationException::withMessages([
                        'date_of_appointment' => __('messages.appointment-exists'),
                        'time_of_appointment' => __('messages.appointment-exists'),
                     ]);
            }
            $appointment = Appointment::create(
                Request::validate([
                    'patient_id' => ['required'],
                    'user_id' => ['required'],
                    'date_of_appointment' => ['required','date',],
                    'time_of_appointment' => ['required'],
                ])
            );
            Notification::create([
                'type' => 'termin-'.$appointment->id,
                'description' => Patient::find(Request::get('patient_id'))->name.' ka terminin për ditën e nesërme në ora '.Request::get('time_of_appointment').'.',
                'date' => Request::get('date_of_appointment'),
                'opened' => false,
            ]);

            return response(__('messages.appointment-add'), 200);
        }
       
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-appointment'))
            return response(__('messages.noauthorization'), 403);
        else {
            return [
                'appointment' => Appointment::findOrFail($id),
                'users' => User::with('role')->get(),
                'patients' => Patient::all(),
            ];
        }
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'create-appointment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $appointment = Appointment::findOrFail($id);
            if(Appointment::where('date_of_appointment','=',Request::get('date_of_appointment'))
                                ->where('time_of_appointment','=',Request::get('time_of_appointment'))
                                ->where('user_id','=',Request::get('user_id'))
                                ->where('id','!=', $appointment->id)
                                ->count()  > 0)
                {
                        throw ValidationException::withMessages([
                            'date_of_appointment' => __('messages.appointment-exists'),
                            'time_of_appointment' => __('messages.appointment-exists'),
                        ]);
                }
                $appointment->update(
                    Request::validate([
                        'patient_id' => ['required'],
                        'user_id' => ['required'],
                        'date_of_appointment' => ['required','date'],
                        'time_of_appointment' => ['required'],
                    ])
                );
                $notification = Notification::where('type','=','termin-'.$appointment->id)->first();
                $notification->update([
                    'type' => 'termin-'.$appointment->id,
                    'description' => Patient::find(Request::get('patient_id'))->name.' ka terminin për ditën e nesërme në ora '.Request::get('time_of_appointment').'.',
                    'date' => Request::get('date_of_appointment'),
                    'opened' => false,
                ]);

                return response(__('messages.appointment-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-appointment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();
            return response(__('messages.appointment-delete'), 200);
        }
    }
}
