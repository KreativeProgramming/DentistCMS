<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Notification;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        $notification->update([
            'opened' => true
        ]);
        return Redirect::back();
    }
}
