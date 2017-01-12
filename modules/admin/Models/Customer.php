<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'address_one',
        'address_two',
        'address_three',
        'city',
        'state',
        'zip',
        'country',
        'phone_number',
        'fax_number',
        'email_one',
        'email_two',
        'email_three',
        'email_four',
        'notes',
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
