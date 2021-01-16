<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Visit;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'color',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function visit()
    {
        return $this->hasMany(Visit::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function getLogo()
    {
        $company = DB::table('company')->first();
        if (empty($company))
            return null;
        if (substr($company->logo, 0, 4) === "http")
            return $company->logo;
        return asset('images/' . $company->logo . '');
    }

    public static function getAppName()
    {
        $company = DB::table('company')->first();
        if (empty($company))
            return 'DentistCMS';
        return $company->name;
    }

    public static function getAppTheme()
    {
        $company = DB::table('company')->first();
        if (empty($company)) {
            return false;
        } else
            return $company->theme;
    }

    public function hasPermission($perm)
    {
        $role = Role::find($this->role_id);
        foreach ($role->permissions as $permission) {
            if ($permission->slug == $perm)
                return true;
        }
        return false;
    }

    public static function getRolesCount($id)
    {
        $role = User::where('role_id', '=', $id)->count();
        return $role;
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeOrderByEmail($query)
    {
        $query->orderBy('email');
    }

    public function scopeOrderByRole($query)
    {
        $query->orderBy('role_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
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
