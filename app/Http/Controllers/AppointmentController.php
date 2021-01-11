<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $users = User::with('role')->get();
        $pacients = Pacient::all();
        $appointments = Appointment::with('user')->with('pacient')->get();
        return Inertia::render('Appointment/index', [
            'users' => $users,
            'pacients' => $pacients,
            'appointments' => $appointments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pacient_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'date_of_appointment' => 'required|date',
        ]);
        $error = \Illuminate\Validation\ValidationException::withMessages([
            'date_of_appointment' => ['Termini në këtë datë dhe orë egziston'],
            'time_of_appointment' => ['Termini në këtë datë dhe orë egziston'],
        ]);
        $appointments = Appointment::where('date_of_appointment', '=', $request->input('date_of_appointment'))
            ->where('time_of_appointment', '=', $request->input('time_of_appointment'))->get();
        if (count($appointments))
            throw $error;
        $appointment = new Appointment;
        $appointment->pacient_id = $request->input('pacient_id');
        $appointment->user_id = $request->input('user_id');
        $appointment->date_of_appointment = $request->input('date_of_appointment');
        $appointment->time_of_appointment = $request->input('time_of_appointment');
        $appointment->save();
        $pacient = Pacient::find($request->input('pacient_id'));
        $notifications = new Notification;
        $notifications->type = 'termin-' . $appointment->id;
        $notifications->description = $pacient->name .' ka terminin për ditën e nesërme në ora ' . $appointment->time_of_appointment . '.';
        $notifications->date = $request->input('date_of_appointment');
        $notifications->opened = false;
        $notifications->save();
        return redirect(route('appointment.index'))->with('success', __('messages.appointment-add'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pacient_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'date_of_appointment' => 'required|date',
        ]);
        $error = \Illuminate\Validation\ValidationException::withMessages([
            'date_of_appointment' => ['Termini në këtë datë dhe orë egziston'],
            'time_of_appointment' => ['Termini në këtë datë dhe orë egziston'],
        ]);
        $appointments = Appointment::where('date_of_appointment', '=', $request->input('date_of_appointment'))
            ->where('time_of_appointment', '=', $request->input('time_of_appointment'))->get();
        if (count($appointments))
            throw $error;
        $appointment = Appointment::find($id);
        $pacient = Pacient::find($appointment->pacient_id);
        $notifications = Notification::where('type', '=', 'termin-' . $appointment->id)->first();
        $appointment->pacient_id = $request->input('pacient_id');
        $appointment->user_id = $request->input('user_id');
        $appointment->date_of_appointment = $request->input('date_of_appointment');
        $appointment->time_of_appointment = $request->input('time_of_appointment');
        $appointment->save();
        if (!empty($notifications)) {
            $notifications->description = $pacient->name. ' ka terminin për ditën e nesërme në ora ' . $appointment->time_of_appointment . '.';
            $notifications->date =  $request->input('date_of_appointment');
            $notifications->opened = false;
            $notifications->save();
        }
        return redirect(route('appointment.index'))->with('success', __('messages.appointment-edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $pacient = Pacient::find($appointment->pacient_id);
        $notifications = Notification::where('type', '=', 'termin-' . $appointment->id)->first();
        if (!empty($notifications)) {
            $notifications->delete();
        }
        $appointment->delete();
        return redirect(route('appointment.index'))->with('success', __('messages.appointment-delete'));
    }
}
