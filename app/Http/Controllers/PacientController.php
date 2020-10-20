<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Pacient;


class PacientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacients = Pacient::all();
        return Inertia::render('Pacient/index', ['pacients' => $pacients]);
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
            'first_name' => 'required|min:3',
            'fathers_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'personal_number' => 'required|digits:10|numeric',
            'date_of_birth' => 'required|date',
            'address' => 'required|min:2',
            'residence' => 'required|min:2',
            'city' => 'required|min:2',
            'phone' => 'required|min:9|numeric',
        ]);
        $pacient = new Pacient;
        $pacient->first_name = $request->input('first_name');
        $pacient->fathers_name = $request->input('fathers_name');
        $pacient->last_name = $request->input('last_name');
        $pacient->personal_number = $request->input('personal_number');
        $pacient->date_of_birth = $request->input('date_of_birth');
        $pacient->gender = $request->input('gender');
        $pacient->address = $request->input('address');
        $pacient->residence = $request->input('residence');
        $pacient->city = $request->input('city');
        $pacient->phone = $request->input('phone');
        $pacient->email = $request->input('email');
        $pacient->save();
        return redirect(route('pacient.index'))->with('success', __('messages.patient-add'));
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
            'first_name' => 'required|min:3',
            'fathers_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'personal_number' => 'required|digits:10|numeric',
            'date_of_birth' => 'required|date',
            'address' => 'required|min:2',
            'residence' => 'required|min:2',
            'city' => 'required|min:2',
            'phone' => 'required|min:9|numeric',
        ]);
        $pacient =  Pacient::find($id);
        $pacient->first_name = $request->input('first_name');
        $pacient->fathers_name = $request->input('fathers_name');
        $pacient->last_name = $request->input('last_name');
        $pacient->personal_number = $request->input('personal_number');
        $pacient->date_of_birth = $request->input('date_of_birth');
        $pacient->gender = $request->input('gender');
        $pacient->address = $request->input('address');
        $pacient->residence = $request->input('residence');
        $pacient->city = $request->input('city');
        $pacient->phone = $request->input('phone');
        $pacient->email = $request->input('email');
        $pacient->save();
        return redirect(route('pacient.index'))->with('success', __('messages.patient-edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pacient = Pacient::find($id);
        $pacient->appointment()->delete();
        $pacient->visit()->delete();
        $treatment = $pacient->treatment()->get();
        foreach ($treatment as $tr) {
            $tr->report()->delete();
            $tr->services()->detach();
            $tr->delete();
        }
        $pacient->report()->delete();
        $pacient->delete();
        return redirect(route('pacient.index'))->with('success', __('messages.patient-delete'));
    }
}
