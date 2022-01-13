<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-role'))
            return response(__('messages.noauthorization'), 403);
        else
            return Role::all();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-role'))
            return response(__('messages.noauthorization'), 403);
        else {
            Request::validate([
                'name' => ['required', 'min:3'],
                'permissions' => ['required'],
            ]);

            $role = Role::create([
                'name' => Request::get('name'),
                'slug' =>  Str::slug(Request::get('name')),
                
            ]);
            $role->permissions()->sync(Request::get('permissions'));

            return response(__('messages.role-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-role'))
            return response(__('messages.noauthorization'), 403);
        else
            return Role::findOrFail($id);
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-role'))
            return response(__('messages.noauthorization'), 403);
        else {
            $role = Role::findOrFail($id);
            Request::validate([
                'name' => ['required', 'min:3'],
                'permissions' => ['required'],
            ]);

            $role->update([
                'name' => Request::get('name'),
                'slug' =>  Str::slug(Request::get('name')),
            ]);
            $role->permissions()->sync(Request::get('permissions'));

            return response(__('messages.role-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-role'))
            return response(__('messages.noauthorization'), 403);
        else {
            $role = Role::findOrFail($id);
            $role->users()->delete();
            $role->delete();
            return response(__('messages.role-delete'), 200);
        }
    }
}
