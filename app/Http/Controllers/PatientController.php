<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Patient;

class PatientController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-patient'))
            return response(__('messages.noauthorization'), 403);
        else
            return Patient::all();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-patient'))
            return response(__('messages.noauthorization'), 403);
        else {
            Patient::create(
                Request::validate([
                    'name' => ['required', 'min:3'],
                    'personal_number' => ['required', 'digits:10','numeric', 'unique:patients'],
                    'date_of_birth' => ['required', 'date'],
                    'address' => ['required', 'min:2'],
                    'residence' => ['required', 'min:2'],
                    'city' => ['required', 'min:2'],
                    'phone' => ['required', 'min:9','numeric'],
                    'email' => ['required','email'],
                    'gender' => ['required'],
                ])
            );

            return response(__('messages.patient-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-patient'))
            return response(__('messages.noauthorization'), 403);
        else {
            return ['patient' => Patient::findOrFail($id)];
        }
    }

   
    public function update(Request $request, $id)
    {
        if(Gate::denies('access', 'update-patient'))
            return response(__('messages.noauthorization'), 403);
        else {
            $patient = Patient::findOrFail($id);
            $patient->update(
                Request::validate([
                    'name' => ['required', 'min:3'],
                    'personal_number' => ['required', 'digits:10','numeric', 'unique:patients'],
                    'date_of_birth' => ['required', 'date'],
                    'address' => ['required', 'min:2'],
                    'residence' => ['required', 'min:2'],
                    'city' => ['required', 'min:2'],
                    'phone' => ['required', 'min:9','numeric'],
                    'email' => ['required','email'],
                    'gender' => ['required'],
                ])
            );

            return response(__('messages.patient-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-patient'))
            return response(__('messages.noauthorization'), 403);
        else{
            $patient = Patient::findOrFail($id);
            $patient->appointment()->delete();
            $patient->visit()->delete();
            $treatment = $patient->treatment()->get();
            foreach ($treatment as $tr) {
                $tr->report()->delete();
                $tr->services()->detach();
                $tr->delete();
            }
            $patient->report()->delete();
            $patient->delete();
            return response(__('messages.patient-delete'), 200);
        }
    }
}
