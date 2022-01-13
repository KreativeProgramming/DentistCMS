<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['patient_id','starting_date','duration','file'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public static function getTreatment($id)
    {
        $treatment = Treatment::find($id);
        $patient = Patient::find($treatment->patient_id);
        return $patient->name . ' (' . $treatment->starting_date . ' | ' . $treatment->duration . ')';
    }

    public function scopeOrderByDate($query)
    {
        $query->orderBy('created_at','desc');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('starting_date', 'like', '%'.$search.'%')
                    ->orWhere('duration', 'like', '%'.$search.'%')
                    ->orWhereHas('patient', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
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
