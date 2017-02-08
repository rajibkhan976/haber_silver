<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Modules\User\Models\Role;

#use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Notifiable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'image',
        'thumb',
        'auth_key',
        'access_token',
        'ip_address',
        'last_visit',
        'roles_id',
        'status',
        'remember_token',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //check permission
    public function can_access($permission = null){

        return !is_null($permission)  && $this->checkPermission($permission);
    }

    //check if the permission matches with any permission user has
    protected function checkPermission($perm){

        $permissions = $this->getAllPermissionFromAllRoles();

        $permissionArray = is_array($perm) ? $perm : [$perm];
        return array_intersect($permissions, $permissionArray);


    }

    //Get All permission slugs from all permission of all roles
    protected function getAllPermissionFromAllRoles(){

        $permissionsArray = [];

        $role = Role::findOrFail(\Auth::user()->roles_id);
        $permissions = $role->permissions()->get()->toArray();

        return array_map('strtolower', array_unique(array_flatten(array_map(function($permission){
            return array_pluck(array($permission), 'route_url');
        }, $permissions))));

    }

    /*
     * Object relational mapping
    */
    public function relRole(){
        return $this->belongsTo('\Modules\User\Models\Role', 'roles_id', 'id');
    }

    // get role
    /**
     * @param $role_id
     * @return bool
     */
    public static function getRole($role_id)
    {
        if(Auth::check())
        {
            $role = Role::where('id', $role_id)->first();
            $data = $role['slug'];
            return $data;
        }else{
            return false;
        }
    }


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                $query->updated_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }


    //TODO:: Setter and Getter
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /*public function getUsernameAttribute($value)
    {
        return strtok($value, '@');
    }*/



}
