<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Debt;
use App\Models\Patient;
use App\Models\Notification;

class DebtController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-debt'))
            return response(__('messages.noauthorization'), 403);
        else
            return Debt::with('patient')->get();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-debt'))
        return response(__('messages.noauthorization'), 403);
    else {
        $debt = Debt::create(
            Request::validate([
                'patient_id' => ['required'],
                'value' => ['required','numeric',],
                'deadline' => ['required','date'],
            ])
        );
        Notification::create([
            'type' => 'Debt-'.$debt->id,
            'description' => Patient::find(Request::get('patient_id'))->name.' borgji ka afat deri në datën: '.Request::get('deadline').'.',
            'date' => Request::get('deadline'),
            'opened' => false,
        ]);
        return response(__('messages.debt-add'), 200);
    }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-debt'))
            return response(__('messages.noauthorization'), 403);
        else
            return [
                'debt' => Debt::findOrFail($id),
                'patients' => Patient::all(),
            ];
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-debt'))
            return response(__('messages.noauthorization'), 403);
        else {
            $debt = Debt::findOrFail($id);
            $debt->update(
                Request::validate([
                'patient_id' => ['required'],
                'value' => ['required','numeric',],
                'deadline' => ['required','date'],
                ])
            );
            $notification = Notification::where('type','=','Debt-'.$debt->id)->first();
            $notification->update([
                'type' => 'Debt-'.$debt->id,
                'description' => Patient::find(Request::get('patient_id'))->name.' borgji ka afat deri në datën: '.Request::get('deadline').'.',
                'date' => Request::get('deadline'),
                'opened' => false,
            ]);
            return response(__('messages.debt-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-bill'))
            return response(__('messages.noauthorization'), 403);
        else {
            $debt = Debt::findOrFail($id);
            $debt->delete();
            return response(__('messages.debt-delete'), 200);
        }
    }
}
