<?php



namespace Modules\Admin\Controllers;

use App\Helpers\AdminLogFileHelper;
use App\Http\Helpers\DirectoryCheckPermission;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Helpers\ActivityLogs;
use App\Helpers\UserLogFileHelper;
use Modules\Admin\Models\ProductCategory;
use Modules\Admin\Models\ProductCategoryImage;
use Image;
use File;
use Validator;


class ProductCategoryImageController extends Controller
{


    protected $image_path;
    protected $thumb_path;
    protected $image_relative_path;
    protected $thumb_relative_path;

    public function __construct()
    {
        $this->image_path = public_path('uploads/product_category/image');
        $this->thumb_path = public_path('uploads/product_category/thumb');
        $this->image_relative_path = '/uploads/product_category/image';
        $this->thumb_relative_path = '/uploads/product_category/thumb';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_product_category_image(Requests\ProductCategoryImageRequest $request)
    {
        $input = $request->all();
        $title = $input['title'];

        $data=ProductCategoryImage::where('title', '=', $title)->exists(); // return bool

        //For Image Upload and insert data into product_category_image
        $file = Input::file('images');

        dd($input);

        if( $data='false')
        {
            if($file != "") {

                    $rules = array('images' => 'required|mimes:png,gif,jpeg');
                    $validator = Validator::make(array('images' => $file), $rules);

                    if ($validator->passes()) {
                        $destinationPath1 = $this->image_path;
                        $destinationPath2 = $this->thumb_path;
                        $imagename = $file->getClientOriginalName();
                        $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                            DirectoryCheckPermission::is_dir_set_permission($this->image_path);
                            DirectoryCheckPermission::is_dir_set_permission($this->thumb_path);
                        $file->move($destinationPath1, $imagename);
                        $thumb_img->save($destinationPath2 . '/' . $imagename, 100);


                    }
            }


            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if($file != "") {
                    $input_image = $this->image_relative_path . '/' . $imagename;
                    $input_thumb = $this->thumb_relative_path . '/' . $imagename;
                    $model = new ProductCategoryImage();
                    $model->product_cat_id = $input['product_cat_id'];
                    $model->image = $input_image;
                    $model->thumb = $input_thumb;
                    $model->alt = $input['alt'];
                    $model->title = $input['title'];
                    $model->status = $input['status'];
                    $model->save();
                }



                //set user activity data
                $action_name = 'create a role';
                $action_url = 'admin/store-product-category-image';
                $action_detail = @\Auth::user()->username.' '. 'create a product category image :: '.@$input['title'];
                $action_table = 'product_category_image';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                AdminLogFileHelper::log_info('store-product-category-image', 'Successfully Added', ['Product Category Name '.$input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-product-category-image', $e->getMessage(), ['Product Category Name'.$input['title']]);
                Session::flash('danger', $e->getMessage());

            }

        }else{
            Session::flash('info', 'This Product Category Image Title already added!');

        }
        //return redirect()->route('admin.index.product.category');
        return redirect()->back();
        /*--------------------------------------------------------------------*/

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Product Category Image Informations";
        $data = ProductCategoryImage::where('id',$id)->first();
        $edit_cons = 'edit';

        //set user activity data
        $action_name = 'Edit Product Category';
        $action_url = 'admin/edit-product-category';
        $action_detail = @\Auth::user()->username.' '. 'edit product category by :: '.@$data->name;
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_category_image.update', [
            'data'      => $data,
            'pageTitle' => $pageTitle,
            'edit_cons' => $edit_cons,
        ]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductCategoryImageRequest $request, $id)
    {
        $input = $request->all();
        $title = strtolower($input['title']);

        $table_query = ProductCategoryImage::where('id', '=', $id)->first();
        $query_title = $table_query->title;

        //For Image Upload and insert data into product_category_image
        $file = Input::file('images');


        if($title != $query_title ){

                $data = ProductCategoryImage::where('title', '=', $title)->exists(); // return bool
                if ($data = 'false') {

                        $model = ProductCategoryImage::where('id', '=', $id)->first();

                        if ($file != "") {

                                $rules = array('images' => 'required|mimes:png,gif,jpeg');
                                $validator = Validator::make(array('images' => $file), $rules);

                                if ($validator->passes()) {
                                    $destinationPath1 = $this->image_path;
                                    $destinationPath2 = $this->thumb_path;
                                    $imagename = $file->getClientOriginalName();
                                    $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                                    $file->move($destinationPath1, $imagename);
                                    $thumb_img->save($destinationPath2 . '/' . $imagename, 100);


                                    $input_image = $this->image_relative_path . '/' . $imagename;
                                    $input_thumb = $this->thumb_relative_path . '/' . $imagename;

                                    $model->product_cat_id = $input['product_cat_id'];
                                    $model->image = $input_image;
                                    $model->thumb = $input_thumb;
                                    $model->alt = $input['alt'];
                                    $model->title = $title;
                                    $model->status = $input['status'];

                                }
                        }else {
                            $model->alt = $input['alt'];
                            $model->title = $title;
                            $model->status = $input['status'];
                        }


                /* Transaction Start Here */
                DB::beginTransaction();
                try {

                    $model->update();
                    ProductCategoryImage::boot();

                    //set user activity data
                    $action_name = 'create a product category image';
                    $action_url = 'admin/store-product-category-image';
                    $action_detail = @\Auth::user()->username . ' ' . 'create a product category image :: ' . @$input['title'];
                    $action_table = 'product_category_image';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                    DB::commit();
                    AdminLogFileHelper::log_info('update-product-category-image', 'Successfully Added', ['Product Category Name '.$input['title']]);
                    Session::flash('message', 'Successfully Updated!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    AdminLogFileHelper::log_error('update-product-category-image', $e->getMessage(), ['Product Category Name'.$input['title']]);
                    Session::flash('danger', $e->getMessage());

                }

            } else {
                Session::flash('info', 'This Product Category already added!');
            }

        }else{


            $model = ProductCategoryImage::where('id', '=', $id)->first();

            if ($file != "") {

                $rules = array('images' => 'required|mimes:png,gif,jpeg');
                $validator = Validator::make(array('images' => $file), $rules);

                if ($validator->passes()) {
                    $destinationPath1 = $this->image_path;
                    $destinationPath2 = $this->thumb_path;
                    $imagename = $file->getClientOriginalName();
                    $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                    $file->move($destinationPath1, $imagename);
                    $thumb_img->save($destinationPath2 . '/' . $imagename, 100);


                    $input_image = $this->image_relative_path . '/' . $imagename;
                    $input_thumb = $this->thumb_relative_path . '/' . $imagename;

                    $model->product_cat_id = $input['product_cat_id'];
                    $model->image = $input_image;
                    $model->thumb = $input_thumb;
                    $model->alt = $input['alt'];
                    $model->title = $title;
                    $model->status = $input['status'];

                }
            }else {
                $model->alt = $input['alt'];
                $model->title = $title;
                $model->status = $input['status'];
            }


            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $model->update();
                ProductCategoryImage::boot();

                //set user activity data
                $action_name = 'create a product category image';
                $action_url = 'admin/store-product-category-image';
                $action_detail = @\Auth::user()->username . ' ' . 'create a product category image :: ' . @$input['title'];
                $action_table = 'product_category_image';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                AdminLogFileHelper::log_info('update-product-category-image', 'Successfully Added', ['Product Category Name '.$input['title']]);
                Session::flash('message', 'Successfully Updated!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('update-product-category-image', $e->getMessage(), ['Product Category Name'.$input['title']]);
                Session::flash('danger', $e->getMessage());

            }
        }
        return redirect()->back();
        /*--------------------------------------------------------------------*/
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != null){
            $model = ProductCategoryImage::where('id',$id)->first();
            DB::beginTransaction();
            try {

                    $model->delete();
                    //set data
                    $action_name = 'cancel the Product category image';
                    $action_url = 'user/delete-product-category-image';
                    $action_detail = @\Auth::user()->username.' '. 'delete a product category image :: '.$model->title;
                    $action_table = 'product_category_image';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);



                DB::commit();
                AdminLogFileHelper::log_info('delete-product-category-image', "Successfully Deleted.", ['Product Category '.$model->title]);
                Session::flash('message', "Successfully Deleted.");
            } catch(\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-product-category-image', $e->getMessage(), ['Product Category Title '.$model->title]);
                Session::flash('danger',$e->getMessage());
            }
        }
        return redirect()->back();
    }





}