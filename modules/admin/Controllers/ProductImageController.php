<?php

namespace Modules\Admin\Controllers;

use App\Helpers\AdminLogFileHelper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Helpers\ActivityLogs;
use Modules\Admin\Models\ProductImage;
use Modules\Admin\Models\Product;
use App\Http\Helpers\DirectoryCheckPermission;
use Image;
use File;
use Validator;



class ProductImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $image_path;
    protected $thumb_path;
    protected $image_store_path;
    protected $thumb_store_path;

    public function __construct()
    {
        $this->image_path = public_path('uploads/product-image/images');
        $this->thumb_path = public_path('uploads/product-image/thumbs');
        $this->image_store_path = '/uploads/product-image/images';
        $this->thumb_store_path = '/uploads/product-image/thumbs';
      
    }

    public function index()
    { //die();
        $pageTitle = "Product Image List";
        $title = strtolower(Input::get('title'));
        $data = ProductImage::with('product')->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'DESC')->paginate(30);       
       
        //product dropdown
        $products = Product::pluck('title','id');         

        //set data
        $action_name = 'Product Image Index';
        $action_url = 'admin/product-image';
        $action_detail = @\Auth::user()->username . ' ' . 'View all list of product image';
        $action_table = 'product_image';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_image.index', [
            'data' => $data,
            'pageTitle' => $pageTitle,
            'products'=> $products

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response \ProductImageRequest
     */
    public function store_product_image(Requests\ProductCategoryRequest $request)
    {

        $files = Input::file('images');
        $title = strtolower($request->title);
        if ($files !=null) {

            $images_name=[];

            if($files != "") {
                foreach ($files as $file) {
                    $rules = array('images' => 'required|mimes:png,gif,jpeg');
                    $validator = Validator::make(array('images' => $file), $rules);

                    if ($validator->passes()) {
                        /*$destinationPath1 = public_path('uploads/product_category/image');
                        $destinationPath2 = public_path('uploads/product_category/thumb');*/
                        $imagename = $title.'-'.time().'.' . $file->getClientOriginalExtension();
                        $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                        $file->move($this->image_path, $imagename);
                        $thumb_img->save($this->thumb_path . '/' . $imagename, 100);
                        $images_name[] .= $imagename;
                    }
                }
            }           

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                    
                    if(count($images_name )>0)
                    {                       
                       
                        foreach ($images_name as $image_name) { 

                            $productImage = new ProductImage();
                            $productImage->title = $request->title;
                            $productImage->product_id = $request->product_id;
                            $productImage->alt = $request->alt;
                            $productImage->image = $this->image_store_path . '/' . $image_name;
                            $productImage->thumb = $this->thumb_store_path . '/' . $image_name;
                            $productImage->status = $request->status;
                            $productImage->save();

                            ProductImage::boot();
                        }                       
                    }                

                DB::commit();

                AdminLogFileHelper::log_info('store-product-image', 'Successfully Added', ['Product Image Title ' . $request->title]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_info('store-product-image', 'Successfully Added', ['Product Image Title ' . $request->title]);
                Session::flash('danger', $e->getMessage());
            }


        } else {
            Session::flash('info', 'This Product Image already added!');

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
        $pageTitle = 'Product Image List';

        $data = ProductImage::where('product_id', $id)->get();
        $products = Product::pluck('title','id'); 

        //set user activity data
        $action_name = 'View Product Image';
        $action_url = 'admin/view-product-image-details';
        $action_detail = @\Auth::user()->username.' '. 'view product image details by :: '.@$data->title;
        $action_table = 'product_image';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::product_image.index-image', [
            'data'      => $data,
            'pageTitle' => $pageTitle,  
            'products'  => $products,       
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
        $pageTitle = "Update Product Image Informations";
        $data = ProductImage::where('id', $id)->first();

        $products = Product::pluck('title','id');
        $edit_cons = 'edit';
       
        //set user activity data
        $action_name = 'Edit Product Image';
        $action_url = 'admin/edit-product-image';
        $action_detail = @\Auth::user()->username . ' ' . 'edit product image, title :: ' . @$data->title;
        $action_table = 'product_image';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_image.update', [
            'data' => $data,
            'pageTitle' => $pageTitle,
            'products' => $products,
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
    public function update(Requests\ProductCategoryRequest $request, $id)
    {
        $files = Input::file('images');
        $title = strtolower($request->title);
        $product_image = ProductImage::where('id',$id)->first();
        if ($files !=null) {

            $images_name = [];

            if($files != "") {
                foreach ($files as $file) {
                    $rules = array('images' => 'required|mimes:png,gif,jpeg');
                    $validator = Validator::make(array('images' => $file), $rules);

                    if ($validator->passes()) {
                        /*$destinationPath1 = public_path('uploads/product_category/image');
                        $destinationPath2 = public_path('uploads/product_category/thumb');*/
                        $imagename = $title.'-'.time().'.' . $file->getClientOriginalExtension();
                        $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                        $file->move($this->image_path, $imagename);
                        $thumb_img->save($this->thumb_path . '/' . $imagename, 100);
                        $images_name[] .= $imagename;
                    }
                }
            }           

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                    
                    if(count($images_name )>0)
                    {                       
                       
                        foreach ($images_name as $image_name) { 

                            $productImage = ProductImage::find($id);
                            $productImage->title = $request->title;
                            $productImage->product_id = $request->product_id;
                            $productImage->alt = $request->alt;
                            $productImage->image = $this->image_store_path . '/' . $image_name;
                            $productImage->thumb = $this->thumb_store_path . '/' . $image_name;
                            $productImage->status = $request->status;
                            $productImage->save();

                            ProductImage::boot();
                        }                       
                    }                

                    DB::commit();

                    AdminLogFileHelper::log_info('update-product-image', 'Successfully updated', ['Product Image Title ' . $request->title]);
                    Session::flash('message', 'Successfully updated!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                AdminLogFileHelper::log_error('update-product-image', $e->getMessage(), ['Product Image Title'.$request['title']]);
                    Session::flash('danger', $e->getMessage());
                }


        } else {

            
                DB::beginTransaction();
                try {
                        
                        if(isset($id))
                        {                       
                           
                            $productImage = ProductImage::find($id);
                            $productImage->title = $request->title;
                            $productImage->product_id = $request->product_id;
                            $productImage->alt = $request->alt;                       
                            $productImage->status = $request->status;
                            $productImage->save();

                            ProductImage::boot();
                        }        

                    DB::commit();

                    AdminLogFileHelper::log_info('store-product-image', 'Successfully updated', ['Product Image Title ' . $request->title]);
                    Session::flash('message', 'Successfully updated!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();               
                    Session::flash('danger', $e->getMessage());
                }            
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
            $model = ProductImage::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($model->status == 'active') {
                    $model->status = 'cancel';
                } else {
                    $model->status = 'active';
                }

                if ($model->save()) {
                    //set data
                    $action_name = 'cancel the product image';
                    $action_url = 'admin/delete-product-image';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes an product image, title :: ' . $model->title;
                    $action_table = 'product_image';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('delete-product-image', "Successfully Deleted.", ['Product Image Title ' . $model->title]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-product-image', $e->getMessage(), ['Product Image Title ' . $model->title]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function search_product_image()
    {
        $pageTitle = 'Product Image Information';
        $title = Input::get('title');
        $data = ProductImage::where('title', 'LIKE', '%' . $title . '%')->paginate(30);

        $products = Product::pluck('title','id');

        //set user activity data
        $action_name = 'search product image';
        $action_url = 'admin/search-product-image';
        $action_detail = @\Auth::user()->username . ' searches product image';
        $action_table = 'product_image';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::product_image.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
            'products' => $products
        ]);
    }

}