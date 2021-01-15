<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use App\Models\Pacient;
use App\Models\Appointment;
use Inertia\Inertia;
use App\Models\Notification;

class AppointmentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Appointment/Index', [
            'filters' =>Request::all('search', 'trashed'),
            'appointments' => Appointment::orderByDate()
                                ->with(['pacient', 'user'])
                                ->filter(Request::only('search', 'trashed'))
                                ->paginate(),

        ]);
    }

    public function create()
    {
        return Inertia::render('Appointment/Create', [
            'users' => User::with('role')->get(),
            'pacients' => Pacient::all(),
        ]);
    }


    public function store()
    {
        Appointment::create(
            Request::validate([
                'pacient_id' => ['required'],
                'user_id' => ['required'],
                'date_of_appointment' => ['required','date'],
                'time_of_appointment' => ['required'],
            ])
        );
        return Redirect::route('appointment.index')->with('success', __('messages.appointment-add'));
    }

    public function edit(Appointment $appointment)
    {
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

    public function update(Appointment $appointment)
    {
        $appointment->update(
            Request::validate([
                'pacient_id' => ['required'],
                'user_id' => ['required'],
                'date_of_appointment' => ['required','date'],
                'time_of_appointment' => ['required'],
            ])
        );
        return Redirect::route('appointment.index')->with('success', __('messages.appointment-edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return Redirect::route('appointment.index')->with('success', __('messages.appointment-delete'));
    }

    public function restore($id)
    {
        $appointment = Appointment::onlyTrashed()->find($id);
        $appointment->restore();
        return Redirect::route('appointment.index')->with('success', 'U rikthye Termini.');
    }

    public function delete($id)
    {
        $appointment = Appointment::onlyTrashed()->find($id);
        $appointment->forceDelete();
        return Redirect::route('appointment.index')->with('success', 'Termini është fshirë përgjithmonë.');
    }
}
