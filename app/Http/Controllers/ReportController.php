<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Report;
use App\Models\User;
use App\Models\Patient;

class ReportController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-report'))
            return response(__('messages.noauthorization'), 403);
        else
            return Report::with(['patient', 'user'])->get();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-report'))
            return response(__('messages.noauthorization'), 403);
        else {
            Report::create(
                Request::validate([
                    'patient_id' => ['required'],
                    'user_id' => ['required'],
                    'complaint' => ['required','min:3'],
                    'evaluation' => ['required','min:3'],
                    'diagnosis' => ['required','min:3'],
                    'recommendation' => ['required','min:3'],
                ])
            );
            return response(__('messages.report-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-report'))
            return response(__('messages.noauthorization'), 403);
        else
            return [
                'report' => Report::findOrFail($id),
                'users' => User::with('role')->get(),
                'patients' => Patient::all(),
            ];
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-report'))
            return response(__('messages.noauthorization'), 403);
        else {
            $report = Report::findOrFail($id);
            $report->update(
                Request::validate([
                    'patient_id' => ['required'],
                    'user_id' => ['required'],
                    'complaint' => ['required','min:3'],
                    'evaluation' => ['required','min:3'],
                    'diagnosis' => ['required','min:3'],
                    'recommendation' => ['required','min:3'],
                ])
            );
            return response(__('messages.report-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-report'))
            return response(__('messages.noauthorization'), 403);
        else {
            $report = Report::findOrFail($id);
            $report->delete();
            return response(__('messages.report-delete'), 200);
        }
    }
}
