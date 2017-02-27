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
use App\Helpers\UserLogFileHelper;
use Modules\Admin\Models\ProductCategory;
use Modules\Admin\Models\ProductSubCategory;
use Modules\Admin\Models\ProductSubCategoryImage;
use Image;
use File;
use Validator;
use App\Http\Helpers\DirectoryCheckPermission;


class ProductSubCategoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Product Sub Category List";

        $name = strtolower(Input::get('title'));
        $data = ProductSubCategory::where('title', 'LIKE', '%'.$name.'%')->orderBy('id', 'DESC')->paginate(30);
        $product_cat = DB::table('product_category')->get();
        //set data
        $action_name = 'Product Sub Category index';
        $action_url = 'admin/product-sub-category';
        $action_detail = @\Auth::user()->username.' '. 'View all list of Product Sub Category ';
        $action_table = 'product_category';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_sub_category.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'product_cat'=>$product_cat,

        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_product_sub_category(Requests\ProductSubCategoryRequest $request)
    {
        $input = $request->all();

        $title=strtolower($input['title']);
        $slug=str_slug($input['title']);
        //$data= ProductCategory::where('slug', '=', $title)->get();

        $data=ProductSubCategory::where('slug', '=', $title)->exists(); // return bool

        //For Image Upload and insert data into product_category_image
        $files = Input::file('images');

        if( $data='false')
        {
            $images_name=[];

            if($files != "") {
                foreach ($files as $file) {
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
                        $images_name[] .= $imagename;

                    }
                }
            }


            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $model = new ProductSubCategory();
                $model->product_category_id= $input['product_category_id'];
                $model->type = $input['type'];
                $model->title = $title;
                $model->slug = $slug;
                $model->status = $input['status'];

                #if(ProductCategory::create($input_data))
                if($model->save())
                {
                    $product_sub_cat_id = $model->id;
                    if($files != "") {
                        foreach ($images_name as $image_name) {
                            $input_image = $this->image_relative_path . '/' . $image_name;
                            $input_thumb = $this->thumb_relative_path . '/' . $image_name;

                            $model2 = new ProductSubCategoryImage();
                            $model2->product_sub_cat_id = $product_sub_cat_id;
                            $model2->image = $input_image;
                            $model2->thumb = $input_thumb;
                            $model2->alt = $title;
                            $model2->title = $title;
                            $model2->status = 'active';
                            $model2->updated_by = 0;

                            $model2->save();

                            ProductSubCategoryImage::boot();

                        }
                    }

                }

                //set user activity data
                $action_name = 'create a product sub category';
                $action_url = 'admin/store-product-sub-category';
                $action_detail = @\Auth::user()->username.' '. 'create a product sub category :: '.@$input['title'];
                $action_table = 'product_sub_category';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                AdminLogFileHelper::log_info('store-product-sub-category', 'Successfully Added', ['Product Sub Category Name '.$input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-product-sub-category', $e->getMessage(), ['Product Sub Category Name'.$input['title']]);
                Session::flash('danger', $e->getMessage());

            }

        }else{
            Session::flash('info', 'This Product Sub Category already added!');

        }
        return redirect()->route('admin.index.product.sub.category');
        /*--------------------------------------------------------------------*/

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'Product Sub Category Details';

        $data = DB::table('product_sub_category')
                ->join('product_category', 'product_sub_category.product_category_id',
                    '=','product_category.id')

                ->join('product_sub_cat_image', 'product_sub_category.id',
                    '=','product_sub_cat_image.product_sub_cat_id')

                ->select('product_sub_cat_image.*',
                     'product_sub_category.product_category_id as cat_id')
                ->where('product_sub_category.id', '=', $id)->get();

                //For get product_category id
                foreach ($data as $values) {
                   $cat_id= $values->cat_id;
                }

            $cat_data = ProductCategory::where('id', '=', @$cat_id)->first();
            $sub_cat_data = ProductSubCategory::where('id', '=', $id)->first();

        //set user activity data
        $action_name = 'View product sub category details';
        $action_url = 'admin/view-product-sub-category-details';
        $action_detail = @\Auth::user()->username.' '. 'view product sub category details by :: '.@$data->title;
        $action_table = 'product_sub_category';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::product_sub_category_image.index', [
            'data'          => $data,
            'pageTitle'     => $pageTitle,
            'cat_data'      => $cat_data,
            'sub_cat_data'  =>$sub_cat_data,
        ]);
    }







    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Product Category Informations";
        $data = ProductSubCategory::where('id',$id)->first();
        $product_cat = DB::table('product_category')->get();
        $edit_cons = 'edit';


        //set user activity data
        $action_name = 'Edit Product Sub Category';
        $action_url = 'admin/edit-product-sub-category';
        $action_detail = @\Auth::user()->username.' '. 'edit product category by :: '.@$data->name;
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_sub_category.update', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'product_cat'=>$product_cat,
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
    public function update(Requests\ProductSubCategoryRequest $request, $id)
    {
        $input = $request->all();

        $title = strtolower($input['title']);
        $slug = str_slug($input['title']);
        $table_query = ProductSubCategory::where('id', '=', $id)->first();
        $query_title = $table_query->title;

        //For Image Upload and insert data into product_category_image
        $files = Input::file('images');

        if($title != $query_title ){

            $data = ProductSubCategory::where('title', '=', $title)->exists(); // return bool
            if ($data = 'false') {
                        $images_name = [];
                        if ($files != "") {
                            foreach ($files as $file) {
                                $rules = array('images' => 'required|mimes:png,gif,jpeg');
                                $validator = Validator::make(array('images' => $file), $rules);

                                if ($validator->passes()) {
                                    $destinationPath1 = $this->image_path;
                                    $destinationPath2 = $this->thumb_path;
                                    $imagename = $file->getClientOriginalName();
                                    $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                                    $file->move($destinationPath1, $imagename);
                                    $thumb_img->save($destinationPath2 . '/' . $imagename, 100);
                                    $images_name[] .= $imagename;
                                }
                            }
                        }

                $input['title'] = $title;
                $input['slug'] = $slug;
                $model = ProductSubCategory::where('id', '=', $id)->first();

                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    $model->update($input);

                    #if(ProductCategory::create($input_data))
                    if ($model->update()) {
                        $product_sub_cat_id = $model->id;
                        if ($files != "") {
                            foreach ($images_name as $image_name) {
                                $input_image = $this->image_relative_path . '/' . $image_name;
                                $input_thumb = $this->thumb_relative_path . '/' . $image_name;

                                $model2 = new ProductSubCategoryImage();
                                $model2->product_sub_cat_id = $product_sub_cat_id;
                                $model2->image = $input_image;
                                $model2->thumb = $input_thumb;
                                $model2->alt = $title;
                                $model2->title = $title;
                                $model2->status = 'active';
                                $model2->updated_by = 0;

                                $model2->save();

                                ProductSubCategoryImage::boot();

                            }
                        }

                    }

                    //set user activity data
                    $action_name = 'create a role';
                    $action_url = 'admin/store-product-category';
                    $action_detail = @\Auth::user()->username . ' ' . 'create a product category :: ' . @$input['title'];
                    $action_table = 'product_category';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                    DB::commit();
                    AdminLogFileHelper::log_info('update-product-sub-category', 'Successfully Added', ['Product Sub Category Name '.$input['title']]);
                    Session::flash('message', 'Successfully Updated!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    AdminLogFileHelper::log_error('update-product-sub-category', $e->getMessage(), ['Product Sub Category Name'.$input['title']]);
                    Session::flash('danger', $e->getMessage());

                }

            } else {
                Session::flash('info', 'This Product Category already added!');

            }
    }else{

            $images_name = [];

            if ($files != "") {
                foreach ($files as $file) {
                    $rules = array('images' => 'mimes:png,gif,jpeg');
                    $validator = Validator::make(array('images' => $file), $rules);

                    if ($validator->passes()) {
                        $destinationPath1 = $this->image_path;
                        $destinationPath2 = $this->thumb_path;
                        $imagename = $file->getClientOriginalName();
                        $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                        $file->move($destinationPath1, $imagename);
                        $thumb_img->save($destinationPath2 . '/' . $imagename, 100);
                        $images_name[] .= $imagename;

                    }
                }
            }

            $input['title'] = $title;
            $input['slug'] = $slug;
            $model = ProductSubCategory::where('id', '=', $id)->first();

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                $model->update($input);

                #if(ProductCategory::create($input_data))
                if ($model->update()) {
                    $product_sub_cat_id = $model->id;
                    if ($files != "") {
                        foreach ($images_name as $image_name) {
                            $input_image = $this->image_relative_path . '/' . $image_name;
                            $input_thumb = $this->thumb_relative_path . '/' . $image_name;

                            $model2 = new ProductSubCategoryImage();
                            $model2->product_sub_cat_id = $product_sub_cat_id;
                            $model2->image = $input_image;
                            $model2->thumb = $input_thumb;
                            $model2->alt = $title;
                            $model2->title = $title;
                            $model2->status = 'active';
                            $model2->updated_by = 0;

                            $model2->save();

                            ProductSubCategoryImage::boot();

                        }
                    }

                }

                //set user activity data
                $action_name = 'create a role';
                $action_url = 'admin/store-product-category';
                $action_detail = @\Auth::user()->username . ' ' . 'create a product category :: ' . @$input['title'];
                $action_table = 'product_category';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                AdminLogFileHelper::log_info('update-product-sub-category', 'Successfully Added', ['Product Sub Category Name '.$input['title']]);
                Session::flash('message', 'Successfully Updated!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('update-product-sub-category', $e->getMessage(), ['Product Sub Category Name'.$input['title']]);
                Session::flash('danger', $e->getMessage());

            }

        }

        return redirect()->route('admin.index.product.sub.category');
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
            $model = ProductSubCategory::where('id',$id)->first();
            DB::beginTransaction();
            try {
                if($model->status =='active'){
                    $model->status = 'cancel';
                }else{
                    $model->status = 'active';
                }

                if($model->save())
                {
                    //set data
                    $action_name = 'cancel the Product Sub category';
                    $action_url = 'user/delete-product-sub-category';
                    $action_detail = @\Auth::user()->username.' '. 'delete a product category :: '.$model->title;
                    $action_table = 'product_category';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                }

                DB::commit();
                AdminLogFileHelper::log_info('delete-product-sub-category', "Successfully Deleted.", ['Product Sub Category '.$model->title]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-product-sub-category', $e->getMessage(), ['Product Sub Category Title '.$model->title]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }


    public function search_product_sub_category()
    {

        $pageTitle = 'Product Sub Category Information';
        $title = Input::get('title');
        $data = ProductSubCategory::where('title', 'LIKE', '%'.$title.'%')->orWhere('status', 'LIKE', '%'.$title.'%')
            ->orWhere('type', 'LIKE', '%'.$title.'%')->paginate(30);


        //set user activity data
        $action_name = 'search product sub category';
        $action_url = 'user/search-product-sub-category';
        $action_detail = @\Auth::user()->username.' '. 'search product sub category by :: '.Input::get('title');
        $action_table = 'product_sub_category';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_sub_category.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
        ]);
    }


}