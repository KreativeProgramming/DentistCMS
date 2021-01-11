<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Treatment;
use App\Models\User;
use App\Models\Pacient;

class Visit extends Model
{
    use HasFactory;

    public function treatment()
    {
        return $this->hasOne(Treatment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pacient()
    {
        return $this->belongsTo(Pacient::class);
    }

    public static function getVisitPacientName($id)
    {
        $visit = Visit::find($id);
        $pacient = Pacient::find($visit->pacient_id);
        return $pacient->name;
    }
}
