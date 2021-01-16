<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','slug'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public static function getRole($id)
    {
        $role = Role::find($id);
        return $role->name;
    }

    public static function hasPermission($id, $perm)
    {
        $role = Role::find($id)->permissions()->where('slug','LIKE',$perm)->count();
        if($role == 0)
            return false;
        else
            return true;
    }

    public function getUserNumberAttribute()
    {
        return $this->users()->count();
    }

    public  function hasAccess($perm)
    {
        $role = $this->permissions()->where('name','LIKE',$perm.'%')->count();
        $permission = Permission::where('name','LIKE',$perm.'%')->count();
        if($role == 0)
            return -1;
        else if($role == $permission)
            return 1;
        else
            return 0;
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
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
