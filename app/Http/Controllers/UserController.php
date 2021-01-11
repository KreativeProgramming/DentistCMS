<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/index', [
            'filters' =>Request::all('search', 'trashed'),
            'users' => User::orderByName()->with('role')
                        ->filter(Request::only('search', 'trashed'))
                        ->paginate(),
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('User/Create', [
            'roles' => $roles,
        ]);
    }


    public function store()
    {
        User::create(
            Request::validate([
                'name' => ['required', 'min:3'],
                'email' => ['required','email','unique:users,email'],
                'password' => ['required','string','min:6','confirmed'],
                'role_id' => ['required'],
                'color' => ['required'],
            ])
        );
        return Redirect::route('user.index')->with('success', __('messages.user-add'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return Inertia::render('User/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'color' => $user->color,
            ],
            'roles' => $roles,
        ]);
    }

    public function update(User $user)
    {
        $user->update(
            Request::validate([
                'name' => ['required', 'min:3'],
                'email' => ['required','email','unique:users,email,'.$user->id,],
                'role_id' => ['required'],
                'color' => ['required'],
            ])
        );
        return Redirect::route('user.index')->with('success', __('messages.user-edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->appointment()->delete();
        $user->visit()->delete();
        $user->delete();
        return Redirect::route('user.index')->with('success', __('messages.user-delete'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return Redirect::route('user.index')->with('success', 'U rikthye Përdoruesi.');
    }

    public function delete($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return Redirect::route('user.index')->with('success', 'Përdoruesi është fshirë përgjithmonë.');
    }
}
