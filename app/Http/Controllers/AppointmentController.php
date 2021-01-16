<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use App\Models\Pacient;
use App\Models\Appointment;
use Inertia\Inertia;
use App\Models\Notification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function index()
    {
        if(Gate::denies('access', 'view-appointment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Appointment/Index', [
                'filters' =>Request::all('search', 'trashed'),
                'appointments' => Appointment::orderByDate()
                                    ->with(['pacient', 'user'])
                                    ->filter(Request::only('search', 'trashed'))
                                    ->paginate(),

            ]);
        }
    }

    public function create()
    {
        if(Gate::denies('access', 'create-appointment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Appointment/Create', [
                'users' => User::with('role')->get(),
                'pacients' => Pacient::all(),
            ]);
        }
    }


    public function store()
    {
        if(Gate::denies('access', 'create-appointment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            if(Appointment::where('date_of_appointment','=',Request::get('date_of_appointment'))->where('time_of_appointment','=',Request::get('time_of_appointment'))->count()  > 0)
            {
                    throw ValidationException::withMessages([
                        'date_of_appointment' => __('messages.appointment-exists'),
                        'time_of_appointment' => __('messages.appointment-exists'),
                     ]);
            }
            $appointment = Appointment::create(
                
                Request::validate([
                    'pacient_id' => ['required'],
                    'user_id' => ['required'],
                    'date_of_appointment' => ['required','date',],
                    'time_of_appointment' => ['required'],
                ])
            );
            Notification::create([
                'type' => 'termin-'.$appointment->id,
                'description' => Pacient::find(Request::get('pacient_id'))->name.' ka terminin për ditën e nesërme në ora '.Request::get('time_of_appointment').'.',
                'date' => Request::get('date_of_appointment'),
                'opened' => false,
            ]);
            return Redirect::route('appointment.index')->with('success', __('messages.appointment-add'));
        }
    }

    public function edit(Appointment $appointment)
    {
        if(Gate::denies('access', 'edit-appointment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Appointment/Edit', [
                'appointment' => [
                    'id' => $appointment->id,
                    'pacient_id' => $appointment->pacient_id,
                    'user_id' => $appointment->user_id,
                    'date_of_appointment' => $appointment->date_of_appointment,
                    'time_of_appointment' => $appointment->time_of_appointment,
                    'user' => $appointment->user,
                    'pacient' => $appointment->pacient,
                ],
                'users' => User::with('role')->get(),
                'pacients' => Pacient::all(),
            ]);
        }
    }

    public function update(Appointment $appointment)
    {
        if(Gate::denies('access', 'edit-appointment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            if(Appointment::where('date_of_appointment','=',Request::get('date_of_appointment'))
                            ->where('time_of_appointment','=',Request::get('time_of_appointment'))
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
                    'pacient_id' => ['required'],
                    'user_id' => ['required'],
                    'date_of_appointment' => ['required','date'],
                    'time_of_appointment' => ['required'],
                ])
            );
            $notification = Notification::where('type','=','termin-'.$appointment->id)->first();
            $notification->update([
                'type' => 'termin-'.$appointment->id,
                'description' => Pacient::find(Request::get('pacient_id'))->name.' ka terminin për ditën e nesërme në ora '.Request::get('time_of_appointment').'.',
                'date' => Request::get('date_of_appointment'),
                'opened' => false,
            ]);
            return Redirect::route('appointment.index')->with('success', __('messages.appointment-edit'));
        }
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return Redirect::route('appointment.index')->with('success', __('messages.appointment-delete'));
    }

    public function restore($id)
    {
        $appointment = Appointment::onlyTrashed()->find($id);
        $appointment->restore();
        return Redirect::route('appointment.index')->with('success', __('messages.appointment-restore'));
    }

    public function delete($id)
    {
        $appointment = Appointment::onlyTrashed()->find($id);
        $appointment->forceDelete();
        return Redirect::route('appointment.index')->with('success',  __('messages.appointment-permanent'));
    }
}
