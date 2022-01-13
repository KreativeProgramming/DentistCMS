<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Visit;
use App\Models\User;
use App\Models\Patient;

class VisitController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-visit'))
            return response(__('messages.noauthorization'), 403);
        else
            return Visit::with(['patient', 'user'])->get();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-visit'))
            return response(__('messages.noauthorization'), 403);
        else{
            Visit::create(
                Request::validate([
                    'patient_id' => ['required'],
                    'user_id' => ['required'],
                    'date_of_visit' => ['required','date',],
                    'time_of_visit' => ['required'],
                ])
            );

            return response(__('messages.visit-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-visit'))
            return response(__('messages.noauthorization'), 403);
        else {
            return [
                'visit' => Visit::findOrFail($id),
                'users' => User::with('role')->get(),
                'patients' => Patient::all(),
            ];
        }
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-visit'))
            return response(__('messages.noauthorization'), 403);
        else{
            $visit = Visit::findOrFail($id);
            $visit->update(
                Request::validate([
                    'patient_id' => ['required'],
                    'user_id' => ['required'],
                    'date_of_visit' => ['required','date',],
                    'time_of_visit' => ['required'],
                ])
            );

            return response(__('messages.visit-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-visit'))
            return response(__('messages.noauthorization'), 403);
        else {
            $visit = Visit::findOrFail($id);
            $visit->delete();
            return response(__('messages.visit-delete'), 200);
        }
    }
}
