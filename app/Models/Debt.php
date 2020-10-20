<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pacient;

class Debt extends Model
{
    use HasFactory;

    public function pacient()
    {
        return $this->belongsTo(Pacient::class);
    }
}
