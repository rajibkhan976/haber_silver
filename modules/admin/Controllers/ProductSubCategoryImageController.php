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
use Modules\Admin\Models\ProductSubCategory;
use Modules\Admin\Models\ProductSubCategoryImage;
use Image;
use File;
use Validator;
use App\Http\Helpers\DirectoryCheckPermission;

class ProductSubCategoryImageController extends Controller
{


        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        protected $image_path;
        protected $thumb_path;
        protected $image_relative_path;
        protected $thumb_relative_path;

        public function __construct()
        {
            $this->image_path = public_path('uploads/product_sub_category/image');
            $this->thumb_path = public_path('uploads/product_sub_category/thumb');
            $this->image_relative_path = '/uploads/product_sub_category/image';
            $this->thumb_relative_path = '/uploads/product_sub_category/thumb';
        }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_product_sub_category_image(Requests\ProductSubCategoryImageRequest $request)
    {
        $input = $request->all();
        $title = $input['title'];

        $data=ProductSubCategoryImage::where('title', '=', $title)->exists(); // return bool

        //For Image Upload and insert data into product_category_image
        $file = Input::file('images');

        //dd($input);

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
                    $model = new ProductSubCategoryImage();
                    $model->product_sub_cat_id = $input['product_sub_cat_id'];
                    $model->image = $input_image;
                    $model->thumb = $input_thumb;
                    $model->alt = $input['alt'];
                    $model->title = $input['title'];
                    $model->status = $input['status'];
                    $model->save();
                }



                //set user activity data
                $action_name = 'create a role';
                $action_url = 'admin/store-product-sub-category-image';
                $action_detail = @\Auth::user()->username.' '. 'create a product sub category image :: '.@$input['title'];
                $action_table = 'product_sub_category_image';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                AdminLogFileHelper::log_info('store-product-sub-category-image', 'Successfully Added', ['Product Sub Category Image Name '.$input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-product-sub-category-image', $e->getMessage(), ['Product Sub Category Image Name'.$input['title']]);
                Session::flash('danger', $e->getMessage());

            }

        }else{
            Session::flash('info', 'This Product Sub Category Image Title already added!');

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
        $pageTitle = "Update Product Sub Category Image Information";
        $data = ProductSubCategoryImage::where('id',$id)->first();
        $edit_cons = 'edit';
        //set user activity data
        $action_name = 'Edit Product Sub Category Image';
        $action_url = 'admin/edit-product-sub-category-image';
        $action_detail = @\Auth::user()->username.' '. 'edit product sub category image by :: '.@$data->name;
        $action_table = ' product_sub_cat_image';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_sub_category_image.update', [
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
    public function update(Requests\ProductSubCategoryImageRequest $request, $id)
    {
        $input = $request->all();
        $title = strtolower($input['title']);

        $table_query = ProductSubCategoryImage::where('id', '=', $id)->first();
        $query_title = $table_query->title;

        //For Image Upload and insert data into product_category_image
        $file = Input::file('images');


        if($title != $query_title ){

            $data = ProductSubCategoryImage::where('title', '=', $title)->exists(); // return bool
            if ($data = 'false') {

                $model = ProductSubCategoryImage::where('id', '=', $id)->first();

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

                        $model->product_sub_cat_id = $input['product_sub_cat_id'];
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
                    ProductSubCategoryImage::boot();

                    //set user activity data
                    $action_name = 'create a product sub category image';
                    $action_url = 'admin/store-product-sub-category-image';
                    $action_detail = @\Auth::user()->username . ' ' . 'create a product sub category image :: ' . @$input['title'];
                    $action_table = 'product_sub_cat_image';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                    DB::commit();
                    AdminLogFileHelper::log_info('update-product-sub-category-image', 'Successfully Added', ['Product Sub Category Image Name '.$input['title']]);
                    Session::flash('message', 'Successfully Updated!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    AdminLogFileHelper::log_error('update-product-sub-category-image', $e->getMessage(), ['Product Sub Category Image Name'.$input['title']]);
                    Session::flash('danger', $e->getMessage());

                }

            } else {
                Session::flash('info', 'This Product Sub Category already added!');
            }

        }else{


            $model = ProductSubCategoryImage::where('id', '=', $id)->first();

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

                    $model->product_sub_cat_id = $input['product_sub_cat_id'];
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
                ProductSubCategoryImage::boot();

                //set user activity data
                $action_name = 'create a product sub category image';
                $action_url = 'admin/store-product-sub-category-image';
                $action_detail = @\Auth::user()->username . ' ' . 'create a product sub category image :: ' . @$input['title'];
                $action_table = 'product_sub_cat_image';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                AdminLogFileHelper::log_info('update-product-sub-category-image', 'Successfully Added', ['Product Sub Category Image Name '.$input['title']]);
                Session::flash('message', 'Successfully Updated!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('update-product-sub-category-image', $e->getMessage(), ['Product Sub Category Image Name'.$input['title']]);
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
            $model = ProductSubCategoryImage::where('id',$id)->first();
            DB::beginTransaction();
            try {

                    $model->delete();
                    //set data
                    $action_name = 'cancel the Product Sub Category image';
                    $action_url = 'user/delete-product-sub-category-image';
                    $action_detail = @\Auth::user()->username.' '. 'delete a product sub category image :: '.$model->title;
                    $action_table = 'product_sub_category_image';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);



                DB::commit();
                AdminLogFileHelper::log_info('delete-product-sub-category-image', "Successfully Deleted.", ['Product Sub Category Image Name'.$model->title]);
                Session::flash('message', "Successfully Deleted.");
            } catch(\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-product-sub-category-image', $e->getMessage(), ['Product Sub Category Image Name '.$model->title]);
                Session::flash('danger',$e->getMessage());
            }
        }
        return redirect()->back();
    }





}