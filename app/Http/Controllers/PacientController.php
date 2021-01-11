<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Pacient;

class PacientController extends Controller
{
    public function index()
    {
        return Inertia::render('Pacient/index', [
            'filters' =>Request::all('search', 'trashed'),
            'pacients' => Pacient::orderByName()
                        ->filter(Request::only('search', 'trashed'))
                        ->paginate(),
        ]);
    }

    public function store()
    {
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
        return Redirect::back()->with('success', __('messages.patient-add'));
    }

    public function update(Pacient $pacient)
    {
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
        return Redirect::back()->with('success', __('messages.patient-edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacient $pacient)
    {
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
        return Redirect::back()->with('success', __('messages.patient-delete'));
    }

    public function restore($id)
    {
        $pacient = Pacient::onlyTrashed()->find($id);
        $pacient->restore();
        return Redirect::back()->with('success', 'Pacient restored.');
    }

    public function delete($id)
    {
        $pacient = Pacient::onlyTrashed()->find($id);
        $pacient->forceDelete();
        return Redirect::back()->with('success', 'Pacient has been deleted permanently.');
    }
}
