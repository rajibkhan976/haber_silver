<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/3/17
 * Time: 2:13 PM
 */

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{

    protected $table = 'product';
    protected $fillable = [
        'product_code',
        'product_category_id',
        'product_sub_category_id',
        'title',
        'slug',
        'cost_price',
        'sell_price',
        'stock_type',
        'quantity',
        'unit_of_measurement',
        'product_type',
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