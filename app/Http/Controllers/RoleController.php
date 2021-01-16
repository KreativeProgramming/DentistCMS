<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    public function index()
    {
        if(Gate::denies('access', 'view-role'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Role/Index', [
                'filters' =>Request::all('search', 'trashed'),
                'roles' => Role::orderByName()
                            ->filter(Request::only('search', 'trashed'))
                            ->paginate()
                            ->transform(function ($role) {
                                return [
                                    'id' => $role->id,
                                    'name' => $role->name,
                                    'slug' => $role->slug,
                                    'userNr' => $role->user_number,
                                    'createAccess' => $role->hasAccess('create'),
                                    'viewAccess' => $role->hasAccess('view'),
                                    'editAccess' => $role->hasAccess('edit'),
                                    'deleteAccess' => $role->hasAccess('delete'),
                                    'deleted_at' => $role->deleted_at,
                                ];
                            }),
            ]);
        }
    }

    public function create()
    {
        if(Gate::denies('access', 'create-role'))
            return Redirect::back()->with('error', __('messages.noauthorization'));
        else{
            return Inertia::render('Role/Create', [
                'permissions' => Permission::all(),
            ]);
        }
    }

    public function store(Request $request)
    {
        if(Gate::denies('access', 'create-role'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{      
            Request::validate([
                'name' => ['required', 'min:3'],
                'permissions' => ['required'],
            ]);

            $role = Role::create([
                'name' => Request::get('name'),
                'slug' =>  Str::slug(Request::get('name')),
                
            ]);
            $role->permissions()->sync(Request::get('permissions'));

            return Redirect::route('role.index')->with('success', __('messages.role-add'));
        }
    }

    public function edit(Role $role)
    {
        if(Gate::denies('access', 'edit-role'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{   
            return Inertia::render('Role/Edit', [
                'role' => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'slug' => $role->slug,
                ],
                'permissions' => $role->permissions()->pluck('id'),
            ]);
        }
    }

    public function update(Role $role)
    {
        if(Gate::denies('access', 'edit-role'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{      
            Request::validate([
                'name' => ['required', 'min:3'],
                'permissions' => ['required'],
            ]);

            $role->update([
                'name' => Request::get('name'),
                'slug' =>  Str::slug(Request::get('name')),
            ]);
            $role->permissions()->sync(Request::get('permissions'));

            return Redirect::route('role.index')->with('success', __('messages.role-edit'));
        }
    }

    public function destroy(Role $role)
    {
        if(Gate::denies('access', 'delete-role'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
            $role->users()->delete();
            $role->delete();
            return Redirect::route('role.index')->with('success', __('messages.role-delete'));
        }
    }

    public function restore($id)
    {
        if(Gate::denies('access', 'delete-role'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
            $role = Role::onlyTrashed()->find($id);
            $role->restore();
            $role->users()->restore();
            return Redirect::route('role.index')->with('success', __('messages.role-restore'));
        }
    }

    public function delete($id)
    {
        if(Gate::denies('access', 'delete-role'))
            return Redirect::back()->with('error', __('messages.noauthorization')); 
        else{
            $role = Role::onlyTrashed()->find($id);
            $role->users()->forceDelete();
            $role->forceDelete();
            return Redirect::route('role.index')->with('success', __('messages.role-permanent'));
        }
    }
}
