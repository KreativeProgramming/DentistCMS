<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','deadline','value'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
