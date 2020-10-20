<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;


class Role extends Model
{
    use HasFactory;

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

    public static function hasAccess($id, $perm)
    {
        $role = Role::find($id)->permissions()->where('name','LIKE',$perm.'%')->count();
        $permission = Permission::where('name','LIKE',$perm.'%')->count();
        if($role == 0)
            return -1;
        else if($role == $permission)
            return 1;
        else
            return 0;

    }

}
