<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Pacient;
use Illuminate\Support\Facades\Gate;

class PacientController extends Controller
{
    public function index()
    {
        if(Gate::denies('access', 'view-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Pacient/Index', [
                'filters' =>Request::all('search', 'trashed'),
                'pacients' => Pacient::orderByName()
                            ->filter(Request::only('search', 'trashed'))
                            ->paginate(),
            ]);
        }
    }

    public function create()
    {
        if(Gate::denies('access', 'create-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Pacient/Create');
        }
    }


    public function store()
    {
        if(Gate::denies('access', 'create-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            Pacient::create(
                Request::validate([
                    'name' => ['required', 'min:3'],
                    'personal_number' => ['required', 'digits:10','numeric', 'unique:pacients'],
                    'date_of_birth' => ['required', 'date'],
                    'address' => ['required', 'min:2'],
                    'residence' => ['required', 'min:2'],
                    'city' => ['required', 'min:2'],
                    'phone' => ['required', 'min:9','numeric'],
                    'email' => ['required','email'],
                    'gender' => ['required'],
                ])
            );
            return Redirect::route('pacient.index')->with('success', __('messages.patient-add'));
        }
    }

    public function edit(Pacient $pacient)
    {
        if(Gate::denies('access', 'edit-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Pacient/Edit', [
                'pacient' => [
                    'id' => $pacient->id,
                    'name' => $pacient->name,
                    'personal_number' => $pacient->personal_number,
                    'date_of_birth' => $pacient->date_of_birth,
                    'address' => $pacient->address,
                    'residence' => $pacient->residence,
                    'city' => $pacient->city,
                    'phone' => $pacient->phone,
                    'email' => $pacient->email,
                    'gender' => $pacient->gender,

                ]
            ]);
        }
    }

    public function update(Pacient $pacient)
    {
        if(Gate::denies('access', 'edit-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            $pacient->update(
                Request::validate([
                    'name' => ['required', 'min:3'],
                    'personal_number' => ['required', 'digits:10','numeric'],
                    'date_of_birth' => ['required', 'date'],
                    'address' => ['required', 'min:2'],
                    'residence' => ['required', 'min:2'],
                    'city' => ['required', 'min:2'],
                    'phone' => ['required', 'min:9','numeric'],
                    'email' => ['required','email'],
                    'gender' => ['required'],
                ])
            );
            return Redirect::route('pacient.index')->with('success', __('messages.patient-edit'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacient $pacient)
    {
        if(Gate::denies('access', 'delete-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
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
            return Redirect::route('pacient.index')->with('success', __('messages.patient-delete'));
        }
    }

    public function restore($id)
    {
        if(Gate::denies('access', 'delete-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            $pacient = Pacient::onlyTrashed()->find($id);
            $pacient->restore();
            $pacient->appointment()->restore();
            $pacient->visit()->restore();
            $pacient->treatment()->restore();
            $treatment = $pacient->treatment()->get();
            foreach ($treatment as $tr) {
                $tr->report()->restore();
                $tr->services()->restore();
            }
            $pacient->report()->restore();
            return Redirect::route('pacient.index')->with('success',  __('messages.patient-restore'));
        }
    }

    public function delete($id)
    {
        if(Gate::denies('access', 'delete-pacient'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            $pacient = Pacient::onlyTrashed()->find($id);
            $pacient->appointment()->forceDelete();
            $pacient->visit()->forceDelete();
            $treatment = $pacient->treatment()->get();
            foreach ($treatment as $tr) {
                $tr->report()->forceDelete();
                $tr->services()->forceDelete();
                $tr->forceDelete();
            }
            $pacient->report()->forceDelete();
            $pacient->forceDelete();
            return Redirect::route('pacient.index')->with('success', __('messages.patient-permanent'));
        }
    }
}
