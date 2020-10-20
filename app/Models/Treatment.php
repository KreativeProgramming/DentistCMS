<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pacient;
use App\Models\Service;

class Treatment extends Model
{
    use HasFactory;

    public function pacient()
    {
        return $this->belongsTo(Pacient::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public static function getTreatment($id)
    {
        $treatment = Treatment::find($id);
        $pacient = Pacient::find($treatment->pacient_id);
        return $pacient->first_name . ' ' . $pacient->last_name . ' (' . $treatment->starting_date . ' | ' . $treatment->duration . ')';
    }
}
