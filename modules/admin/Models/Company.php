<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['name','description','approved_product','price_level_one',
    'price_level_two','discount_a','discount_b','discount_c','mark_up_level_one',
    'mark_up_level_two','mark_up_a','mark_up_b','mark_up_c','letter_head_image',
    'letter_head_thumb','letter_head_text','letter_head_footer','status','created_by','updated_by'];


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

