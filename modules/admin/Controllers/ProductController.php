<?php

namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Helpers\ActivityLogs;
use App\Helpers\AdminLogFileHelper;
use App\Http\Helpers\CodeGenerateHelper;
use Modules\Admin\Models\ProductCategory;
use Modules\Admin\Models\ProductSubCategory;
use Modules\Admin\Models\Product;
use Image;
use File;
use Validator;


class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        
    }

    public function index()
    { 
        $pageTitle = "Product List";
        $title = strtolower(Input::get('title'));
        $data = Product::with('productCategory','productSubCategory')->orderBy('id', 'DESC')->paginate(30);
        //set data
        
        $productCategory = ProductCategory::pluck('title','id');
        $productSubCategory = ProductSubCategory::pluck('title','id');

        $action_name = 'Product Index';
        $action_url = 'admin/product';
        $action_detail = @\Auth::user()->username . ' ' . 'View all list of product';
        $action_table = 'product';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product.index', [
            'data' => $data,
            'pageTitle' => $pageTitle,
            'productCategory' => $productCategory,
            'productSubCategory' => $productSubCategory
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response \ProductImageRequest
     */
    public function store_product(Requests\ProductRequest $request)
    {
        DB::beginTransaction();
        try {  

                $productCodeArr= CodeGenerateHelper::generate_code('product-code');
                if($productCodeArr){
                  $productCode=$productCodeArr['generated_code'];
                  $setting_id=$productCodeArr['setting_id'];
                  $lastNo=$productCodeArr['number'];
                } else{
                    Session::flash('danger', 'Fail to generate product code.');
                    return redirect()->back();
                }
               
             

                $product = new Product();
                $product->product_code = $productCode;
                $product->product_category_id = $request->product_category_id;
                $product->product_sub_category_id = $request->product_sub_category_id;
                $product->title = $request->title;
                $product->slug = $request->slug;
                $product->cost_price = $request->cost_price;
                $product->sell_price = $request->sell_price;
                $product->stock_type = $request->stock_type;
                $product->quantity = $request->quantity;
                $product->unit_of_measurement = $request->unit_of_measurement;
                $product->product_type = $request->product_type;
                $product->status = $request->status;
                
                $product->save();

               CodeGenerateHelper::update_row($setting_id, $lastNo);
              //  dd($productCodeArr);

                Product::boot();                
              
                DB::commit();

                //set user activity data
                $action_name = 'create a customer';
                $action_url = 'user/store-product';
                $action_detail = @\Auth::user()->username.' '. 'create a product :: '.@$request->title;
                $action_table = 'product';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                AdminLogFileHelper::log_info('store-product', 'Successfully Added', ['Product Title ' . $request->title]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-product', $e->getMessage(), ['Product Title Name'.$request['title']]);
                Session::flash('danger', $e->getMessage());
            }       

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $pageTitle = 'Product Information';

        $data = Product::with('productCategory','productSubCategory')->where('id', $id)->first();
//dd($data);
        //set user activity data
        $action_name = 'View Product';
        $action_url = 'admin/view-product-details';
        $action_detail = @\Auth::user()->username.' '. 'view product details by :: '.@$data->title;
        $action_table = 'product';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product.view', [
            'data'      => $data,
            'pageTitle' => $pageTitle             
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Product Informations";
        $data = Product::where('id', $id)->first();
        $edit_cons = 'edit';

        $productCategory = ProductCategory::pluck('title','id');
        $productSubCategory = ProductSubCategory::pluck('title','id');
       
        //set user activity data
        $action_name = 'Edit Product';
        $action_url = 'admin/edit-product';
        $action_detail = @\Auth::user()->username . ' ' . 'edit product, title :: ' . @$data->title;
        $action_table = 'product';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product.update', [
            'data' => $data,
            'pageTitle' => $pageTitle,
            'productCategory' => $productCategory,
            'productSubCategory' => $productSubCategory,
            'edit_cons' => $edit_cons,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductRequest $request, $id)
    {
        
        DB::beginTransaction();
        try {               

                $product = Product::find($id);
                $product->product_code = $request->product_code;
                $product->product_category_id = $request->product_category_id;
                $product->product_sub_category_id = $request->product_sub_category_id;
                $product->title = $request->title;
                $product->slug = $request->slug;
                $product->cost_price = $request->cost_price;
                $product->sell_price = $request->sell_price;
                $product->stock_type = $request->stock_type;
                $product->quantity = $request->quantity;
                $product->unit_of_measurement = $request->unit_of_measurement;
                $product->product_type = $request->product_type;
                $product->status = $request->status;

                $product->save();

                Product::boot();                
              
                DB::commit();

                //set user activity data
                $action_name = 'create a product';
                $action_url = 'user/store-product';
                $action_detail = @\Auth::user()->username.' '. 'create a product :: '.@$request->title;
                $action_table = 'product';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                AdminLogFileHelper::log_info('update-product', 'Successfully updated.', ['Product Title ' . $request->title]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('update-product', $e->getMessage(), ['Product Title ' . $request->title]);
                Session::flash('danger', $e->getMessage());
            }       

        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        if ($id != null) {
            $data = Product::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($data->status == 'active') {
                    $data->status = 'cancel';
                } else {
                    $data->status = 'active';
                }

                if ($data->save()) {
                    //set data
                    $action_name = 'cancel the product';
                    $action_url = 'admin/delete-product';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes an product , title :: ' . $data->title;
                    $action_table = 'product';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('delete-product', "Successfully Deleted.", ['Product Title ' . $data->title]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-product', $e->getMessage(), ['Product Title ' . $data->title]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function search_product()
    {
        $pageTitle = 'Product Information';
        $title = Input::get('title');
        $data = Product::where('title', 'LIKE', '%' . $title . '%')->paginate(30);

        $productCategory = ProductCategory::pluck('title','id');
        $productSubCategory = ProductSubCategory::pluck('title','id');

        //set user activity data
        $action_name = 'search product';
        $action_url = 'admin/search-product';
        $action_detail = @\Auth::user()->username . ' searches product';
        $action_table = 'product';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::product.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'productCategory' => $productCategory,
            'productSubCategory' => $productSubCategory
        ]);
    }

}