<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;

class TreatmentController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-treatment'))
            return response(__('messages.noauthorization'), 403);
        else
            return Treatment::with('patient')->get();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-treatment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $treatment = Treatment::create(
                Request::validate([
                    'patient_id' => ['required'],
                    'starting_date' => ['required','date',],
                    'duration' => ['required'],
                    'file' => ['image','nullable','max:1999'],
                ])
                
            );
            $treatment->services()->attach(Request::input('services'));

            return response(__('messages.treatment-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-treatment'))
        return response(__('messages.noauthorization'), 403);
    else
        return [
            'treatment' => Treatment::findOrFail($id),
            'patients' => Patient::all(),
            'services' => Service::all()
        ];
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'create-treatment'))
        return response(__('messages.noauthorization'), 403);
        else {
            $treatment = Treatment::findOrFail($id);
            $treatment->update(
                Request::validate([
                    'patient_id' => ['required'],
                    'starting_date' => ['required','date',],
                    'duration' => ['required'],
                    'file' => ['image','nullable','max:1999'],
                ])
            );
            $treatment->services()->detach();
            $treatment->services()->attach(Request::input('services'));

            return response(__('messages.treatment-edit'), 200);
        }
       
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-treatment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $treatment = Treatment::findOrFail($id);
            $treatment->delete();
            return response(__('messages.treatment-delete'), 200);
        }
    }
}
