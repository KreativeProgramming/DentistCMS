<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Treatment;
use App\Models\Pacient;
use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
class TreatmentController extends Controller
{
    public function index()
    {
        if(Gate::denies('access', 'view-treatment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Treatment/Index', [
                'filters' =>Request::all('search', 'trashed'),
                'treatments' => Treatment::orderByDate()
                                    ->with('pacient')
                                    ->filter(Request::only('search', 'trashed'))
                                    ->paginate(),

            ]);
        }
    }

    public function create()
    {
        if(Gate::denies('access', 'create-treatment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Treatment/Create', [
                'pacients' => Pacient::all(),
                'services' => Service::all()
            ]);
        }
    }


    public function store()
    {
        if(Gate::denies('access', 'create-treatment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            $treatment = Treatment::create(
                Request::validate([
                    'pacient_id' => ['required'],
                    'starting_date' => ['required','date',],
                    'duration' => ['required'],
                    'file' => ['image','nullable','max:1999'],
                ])
                
            );
            $treatment->services()->attach(Request::input('services'));
            return Redirect::route('treatment.index')->with('success', __('messages.treatment-add'));
        }
    }

    public function edit(Treatment $treatment)
    {
        if(Gate::denies('access', 'edit-treatment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Treatment/Edit', [
                'treatment' => [
                    'id' => $treatment->id,
                    'pacient_id' => $treatment->pacient_id,
                    'starting_date' => $treatment->starting_date,
                    'duration' => $treatment->duration,
                    'file' => $treatment->file,
                    'service' => $treatment->services()->get(),
                    'pacient' => $treatment->pacient,
                ],
                'services' => Service::all(),
                'pacients' => Pacient::all(),
            ]);
        }
    }

    public function update(Treatment $treatment)
    {
        if(Gate::denies('access', 'edit-appointment'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            $treatment->update(
                Request::validate([
                    'pacient_id' => ['required'],
                    'starting_date' => ['required','date',],
                    'duration' => ['required'],
                    'file' => ['image','nullable','max:1999'],
                ])
            );
            $treatment->services()->detach();
            $treatment->services()->attach(Request::input('services'));
            return Redirect::route('treatment.index')->with('success', __('messages.treatment-edit'));
        }
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return Redirect::route('treatment.index')->with('success', __('messages.treatment-delete'));
    }

    public function restore($id)
    {
        $treatment = Treatment::onlyTrashed()->find($id);
        $treatment->restore();
        return Redirect::route('treatment.index')->with('success', __('messages.treatment-restore'));
    }

    public function delete($id)
    {
        $treatment = Treatment::onlyTrashed()->find($id);
        $treatment->services()->detach();
        $treatment->forceDelete();
        return Redirect::route('treatment.index')->with('success',  __('messages.treatment-permanent'));
    }
}
