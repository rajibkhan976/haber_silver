<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserActivity extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_activity';

    /**
     * @var array
     */
    protected $fillable = [
        'action_name',
        'action_url',
        'action_detail',
        'action_table',
        'users_id'
    ];

    //relations
    /*
     * Object relational mapping
    */
    public function relUsers(){
        return $this->hasMany('App\User', 'id', 'users_id' );
        #return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }

    //scopes


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->users_id = @Auth::user()->id;
            }
        });
    }



}
