<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Payment;

class PaymentController extends Controller
{
    
    public function index()
    {
        if(Gate::denies('access', 'view-payment'))
            return response(__('messages.noauthorization'), 403);
        else
            return Payment::with('patient')->get();
    }

   
    public function store()
    {
        if(Gate::denies('access', 'create-payment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $payment = Payment::create(
                Request::validate([
                    'patient_id' => ['required'],
                    'value' => ['required','numeric'],
                ])
            );
            foreach(Request::get('items') as $item)
            {
                $id = $item->serviceId;
                $discount = $item->discount;
                $tooth = $item->tooth;
                $quantity = $item->quantity;
                $payment->services()->attach($id,['tooth' => $tooth, 'discount' => $discount, 'quantity' => $quantity]);
            }
            return response(__('messages.payment-add'), 200);
        }
    }

    
    public function show($id)
    {
        if(Gate::denies('access', 'view-payment'))
            return response(__('messages.noauthorization'), 403);
        else
            return [
                'payment' =>  Payment::findOrFail($id),
                'patients' => Patient::all(),
               
            ];
    }

   
    public function update($id)
    {
        if(Gate::denies('access', 'update-payment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $payment = Payment::findOrFail($id);
            $payment->update(
                Request::validate([
                    'patient_id' => ['required'],
                    'value' => ['required','numeric'],
                ])
            );
            $payment->services()->detach();
            foreach(Request::get('items') as $item)
            {
                $id = $item->serviceId;
                $discount = $item->discount;
                $tooth = $item->tooth;
                $quantity = $item->quantity;
                $payment->services()->attach($id,['tooth' => $tooth, 'discount' => $discount, 'quantity' => $quantity]);
            }
            return response(__('messages.payment-edit'), 200);
        }
    }

    
    public function destroy($id)
    {
        if(Gate::denies('access', 'delete-payment'))
            return response(__('messages.noauthorization'), 403);
        else {
            $payment = Payment::findOrFail($id);
            $payment->services()->detach();
            $payment->delete();
            return response(__('messages.payment-delete'), 200);
        }
    }
}
