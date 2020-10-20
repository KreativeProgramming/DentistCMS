<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pacient;
use App\Models\Service;


class Payment extends Model
{
    use HasFactory;

    public function pacient()
    {
        return $this->belongsTo(Pacient::class);
    }

    public function services()
    {
        return $this->belongsToMany(Services::class)->withPivot('tooth', 'discount', 'quantity');
    }
}
