<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Bill;
use App\Models\Notification;

class BillController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-bill'))
            return response(__('messages.noauthorization'), 403);
        else
            return Bill::all();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-bill'))
            return response(__('messages.noauthorization'), 403);
        else {
            $bill = Bill::create(
                Request::validate([
                    'subject' => ['required','min:3'],
                    'bill-nr' => ['required','min:3'],
                    'value' => ['required','numeric',],
                    'deadline' => ['required','date'],
                    'file'  => ['image','nullable','max:1999'],
                ])
            );
            Notification::create([
                'type' => 'Bill-'.$bill->id,
                'description' => Request::get('subject').' Fatura ka afat deri në datën: '.Request::get('deadline').'.',
                'date' => Request::get('deadline'),
                'opened' => false,
            ]);
            return response(__('messages.bill-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-bill'))
            return response(__('messages.noauthorization'), 403);
        else
            return Bill::findOrFail($id);
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-bill'))
            return response(__('messages.noauthorization'), 403);
        else {
            $bill = Bill::findOrFail($id);
            $bill->update(
                Request::validate([
                    'subject' => ['required','min:3'],
                    'bill-nr' => ['required','min:3'],
                    'value' => ['required','numeric',],
                    'deadline' => ['required','date'],
                    'file'  => ['image','nullable','max:1999'],
                ])
            );
            $notification = Notification::where('type','=','Bill-'.$bill->id)->first();
            $notification->update([
                'type' => 'Bill-'.$bill->id,
                'description' => Request::get('subject').' Fatura ka afat deri në datën: '.Request::get('deadline').'.',
                'date' => Request::get('deadline'),
                'opened' => false,
            ]);
            return response(__('messages.bill-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-bill'))
            return response(__('messages.noauthorization'), 403);
        else {
            $bill = Bill::findOrFail($id);
            $bill->delete();
            return response(__('messages.bill-delete'), 200);
        }
    }
}
