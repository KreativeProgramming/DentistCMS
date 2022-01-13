<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Service;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','value'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function services()
    {
        return $this->belongsToMany(Services::class)->withPivot('tooth', 'discount', 'quantity');
    }
}
