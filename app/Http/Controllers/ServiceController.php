<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Service;

class ServiceController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-service'))
            return response(__('messages.noauthorization'), 403);
        else
            return Service::all();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-service'))
            return response(__('messages.noauthorization'), 403);
        else {
            Service::create(
                Request::validate([
                    'service' => ['required','min:6'],
                    'price' => ['required','numeric'],
                    'discount' => ['required','numeric']
                ])
            );
            return response(__('messages.service-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-service'))
            return response(__('messages.noauthorization'), 403);
        else
            return Service::findOrFail($id);
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-service'))
            return response(__('messages.noauthorization'), 403);
        else {
            $service = Service::findOrFail($id);
            $service->update(
                Request::validate([
                    'service' => ['required','min:6'],
                    'price' => ['required','numeric'],
                    'discount' => ['required','numeric']
                ])
            );
            return response(__('messages.service-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-service'))
            return response(__('messages.noauthorization'), 403);
        else {
            $service = Service::findOrFail($id);
            $service->delete();
            return response(__('messages.service-delete'), 200);
        }
    }
}
