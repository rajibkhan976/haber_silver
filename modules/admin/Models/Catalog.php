<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/3/17
 * Time: 2:11 PM
 */

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Catalog extends Model
{
    protected $table = 'catalog';
    protected $fillable = [
        'title',
        'slug',
        'file',
        'image',
        'thumb',
        'status',


    ];


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = @\Auth::user()->id;
                $query->updated_by = @\Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = @\Auth::user()->id;
            }
        });
    }

}