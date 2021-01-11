<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visit;
use App\Models\Treatment;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\Payment;
use App\Models\Debt;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pacient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','personal_number','date_of_birth','city','address','gender','residence','phone','email'];

    protected $casts = [
        'created_at'    => 'datetime:d/m/Y H:m',
        'updated_at'    => 'datetime:d/m/Y H:m',
    ];

    public function visit()
    {
        return $this->hasMany(Visit::class);
    }

    public function treatment()
    {
        return $this->hasMany(Treatment::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function report()
    {
        return $this->hasMany(Report::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function debt()
    {
        return $this->hasMany(Debt::class);
    }

    public static function getPacient($id)
    {
        $pacient = Pacient::find($id);
        return $pacient->name . ' ' . $pacient->personal_number;
    }

    public static function getPacientName($id)
    {
        $pacient = Pacient::find($id);
        return $pacient->name;
    }

    public static function getPacientID($id)
    {
        $pacient = Pacient::find($id);
        return '' . $pacient->personal_number;
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function getBirthdayAttribute()
    {
        return $this->date_of_birth->format('d/M/Y');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('personal_number', 'like', '%'.$search.'%')
                    ->orWhere('city', 'like', '%'.$search.'%')
                    ->orWhere('address', 'like', '%'.$search.'%')
                    ->orWhere('residence', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('date_of_birth', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
