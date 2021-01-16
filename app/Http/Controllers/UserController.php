<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('access', 'view-user'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('User/Index', [
                'filters' =>Request::all('search', 'trashed'),
                'users' => User::orderByName()->with('role')
                            ->filter(Request::only('search', 'trashed'))
                            ->paginate(),
            ]);
        }
    }

    public function create()
    {
        if(Gate::denies('access', 'create-user'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('User/Create', [
                'roles' => Role::all(),
            ]);
        }
    }


    public function store()
    {
        if(Gate::denies('access', 'create-user'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{      
            Request::validate([
                'name' => ['required', 'min:3'],
                'email' => ['required','email','unique:users,email'],
                'password' => ['required','string','min:6','confirmed'],
                'role_id' => ['required'],
                'color' => ['required'],
            ]);

            User::create([
                'name' => Request::get('name'),
                'email' => Request::get('email'),
                'password' =>  Hash::make(Request::get('password')),
                'role_id' => Request::get('role_id'),
                'color' => Request::get('color'),
            ]);
            
            return Redirect::route('user.index')->with('success', __('messages.user-add'));
        }
    }

    public function edit(User $user)
    {
        if(Gate::denies('access', 'edit-user'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{   
            return Inertia::render('User/Edit', [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'color' => $user->color,
                ],
                'roles' => Role::all(),
            ]);
        }
    }

    public function update(User $user)
    {
        if(Gate::denies('access', 'edit-user'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
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
    }

    public function destroy(User $user)
    {
        if(Gate::denies('access', 'delete-user'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
            $user->appointment()->delete();
            $user->visit()->delete();
            $user->delete();
            return Redirect::route('user.index')->with('success', __('messages.user-delete'));
        }
    }

    public function restore($id)
    {
        if(Gate::denies('access', 'delete-user'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
            $user = User::onlyTrashed()->find($id);
            $user->appointment()->restore();
            $user->visit()->restore();
            $user->restore();
            return Redirect::route('user.index')->with('success',  __('messages.user-restore'));
        }
    }

    public function delete($id)
    {
        if(Gate::denies('access', 'delete-user'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
            $user = User::onlyTrashed()->find($id);
            $user->appointment()->forceDelete();
            $user->visit()->forceDelete();
            $user->forceDelete();
            return Redirect::route('user.index')->with('success',  __('messages.user-permanent'));
        }
    }
}
