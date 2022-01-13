<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if(Gate::denies('access', 'view-user'))
            return response(__('messages.noauthorization'), 403);
        else
            return User::with('role')->get();
    }

    public function store()
    {
        if(Gate::denies('access', 'create-user'))
            return response(__('messages.noauthorization'), 403);
        else {
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

            return response(__('messages.user-add'), 200);
        }
    }

    public function show($id)
    {
        if(Gate::denies('access', 'view-user'))
            return response(__('messages.noauthorization'), 403);
        else {
            return [
                'user' => User::findOrFail($id),
                'roles' => Role::all(),
            ];
        }
    }

    public function update($id)
    {
        if(Gate::denies('access', 'update-user'))
            return response(__('messages.noauthorization'), 403);
        else {
            $user = User::findOrFail($id);
            $user->update(
                Request::validate([
                    'name' => ['required', 'min:3'],
                    'email' => ['required','email','unique:users,email,'.$user->id,],
                    'role_id' => ['required'],
                    'color' => ['required'],
                ])
            );

            return response(__('messages.user-edit'), 200);
        }
    }

    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-user'))
            return response(__('messages.noauthorization'), 403);
        else {
            $user = User::findOrFail($id);
            $user->appointment()->delete();
            $user->visit()->delete();
            $user->delete();
            return response(__('messages.user-delete'), 200);
        }
    }
}
