<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Treatment;
use App\Models\Payment;

class Service extends Model
{
    use HasFactory;

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class)->withTimestamps();
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class)->withTimestamps()->withPivot('tooth', 'discount', 'quantity');
    }

    public static function getName($id)
    {
        $service = Service::find($id);
        return $service->name;
    }
}
