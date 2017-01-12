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
use App\Helpers\UserLogFileHelper;
use Modules\Admin\Models\ProductCategory;
use Modules\Admin\Models\ProductCategoryImage;
use Image;
use File;
use Validator;


class ProductCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Product Category List";

        $name = strtolower(Input::get('title'));
        $data = ProductCategory::where('title', 'LIKE', '%'.$name.'%')->orderBy('id', 'DESC')->paginate(30);

        //set data
        $action_name = 'Product Category index';
        $action_url = 'admin/product-category';
        $action_detail = @\Auth::user()->username.' '. 'View all list of Product Category ';
        $action_table = 'product_category';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_category.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,

        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_product_category(Requests\ProductCategoryRequest $request)
    {
        $input = $request->all();

        $title=strtolower($input['title']);
        $slug=str_slug($input['title']);
        //$data= ProductCategory::where('slug', '=', $title)->get();

        $data=ProductCategory::where('slug', '=', $title)->exists(); // return bool

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
                        $destinationPath1 = public_path('uploads/product_category/image');
                        $destinationPath2 = public_path('uploads/product_category/thumb');
                        $imagename = $file->getClientOriginalName();
                        $thumb_img = Image::make($file->getRealPath())->resize(50, 50);
                        $file->move($destinationPath1, $imagename);
                        $thumb_img->save($destinationPath2 . '/' . $imagename, 100);
                        $images_name[] .= $imagename;

                    }
                }
            }


            /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $model = new ProductCategory();
                $model->type = $input['type'];
                $model->title = $title;
                $model->slug = $slug;
                $model->status = $input['status'];

                #if(ProductCategory::create($input_data))
                if($model->save())
                {
                    $product_category_id = $model->id;
                    if($files != "") {
                        foreach ($images_name as $image_name) {
                            $input_image = '/uploads/product_category/image' . '/' . $image_name;
                            $input_thumb = '/uploads/product_category/thumb' . '/' . $image_name;

                            $model2 = new ProductCategoryImage();
                            $model2->product_cat_id = $product_category_id;
                            $model2->image = $input_image;
                            $model2->thumb = $input_thumb;
                            $model2->alt = $title;
                            $model2->title = $title;
                            $model2->status = 'active';
                            $model2->updated_by = 0;

                            $model2->save();

                            ProductCategoryImage::boot();

                        }
                    }

                }

                //set user activity data
                $action_name = 'create a role';
                $action_url = 'admin/store-product-category';
                $action_detail = @\Auth::user()->username.' '. 'create a product category :: '.@$input['title'];
                $action_table = 'product_category';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                DB::commit();
                //AdminLogFileHelper::log_info('store-product-category', 'Successfully Added', ['Product Category Name '.$input_data['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                //AdminLogFileHelper::log_error('store-product-category', $e->getMessage(), ['Product Category Name'.$input_data['title']]);
                Session::flash('danger', $e->getMessage());

            }

        }else{
            Session::flash('info', 'This Product Category already added!');

        }
        return redirect()->route('admin.index.product.category');
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
        $pageTitle = 'Product Category Details';

        $data = DB::table('product_category')
            ->join('product_category_image', 'product_category_image.product_cat_id', '=', 'product_category.id')
            ->select('product_category_image.*')
            ->where('product_category.id', '=', $id)->get();

        $pc_data = ProductCategory::where('id', '=', $id)->first();

        //set user activity data
        $action_name = 'View product category details';
        $action_url = 'admin/view-product-category-details';
        $action_detail = @\Auth::user()->username.' '. 'view product category details by :: '.@$data->title;
        $action_table = 'product_category';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::product_category_image.index', [
            'data'      => $data,
            'pageTitle' => $pageTitle,
            'pc_data'   => $pc_data,
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
        $data = ProductCategory::where('id',$id)->first();


        //set user activity data
        $action_name = 'Edit Product Category';
        $action_url = 'admin/edit-product-category';
        $action_detail = @\Auth::user()->username.' '. 'edit product category by :: '.@$data->name;
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_category.update', [
            'data' => $data,
            'pageTitle'=> $pageTitle
        ]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductCategoryRequest $request, $id)
    {
        $input = $request->all();

        $title = strtolower($input['title']);
        $slug = str_slug($input['title']);

        $table_query = ProductCategory::where('id', '=', $id)->first();
        $query_title = $table_query->title;

        //For Image Upload and insert data into product_category_image
        $files = Input::file('images');

        if($title != $query_title ){
            $data = ProductCategory::where('title', '=', $title)->exists(); // return bool

            if ($data = 'false') {
                $images_name = [];

                if ($files != "") {
                    foreach ($files as $file) {
                        $rules = array('images' => 'required|mimes:png,gif,jpeg');
                        $validator = Validator::make(array('images' => $file), $rules);

                        if ($validator->passes()) {
                            $destinationPath1 = public_path('uploads/product_category/image');
                            $destinationPath2 = public_path('uploads/product_category/thumb');
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
                $model = ProductCategory::where('id', '=', $id)->first();

                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    $model->update($input);

                    #if(ProductCategory::create($input_data))
                    if ($model->update()) {
                        $product_category_id = $model->id;
                        if ($files != "") {
                            foreach ($images_name as $image_name) {
                                $input_image = '/uploads/product_category/image' . '/' . $image_name;
                                $input_thumb = '/uploads/product_category/thumb' . '/' . $image_name;

                                $model2 = new ProductCategoryImage();
                                $model2->product_cat_id = $product_category_id;
                                $model2->image = $input_image;
                                $model2->thumb = $input_thumb;
                                $model2->alt = $title;
                                $model2->title = $title;
                                $model2->status = 'active';
                                $model2->updated_by = 0;

                                $model2->save();

                                ProductCategoryImage::boot();

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
                    //AdminLogFileHelper::log_info('store-product-category', 'Successfully Added', ['Product Category Name '.$input_data['title']]);
                    Session::flash('message', 'Successfully Updated!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    //AdminLogFileHelper::log_error('store-product-category', $e->getMessage(), ['Product Category Name'.$input_data['title']]);
                    Session::flash('danger', $e->getMessage());

                }

            } else {
                Session::flash('info', 'This Product Category already added!');

            }
    }else{

            $images_name = [];

            if ($files != "") {
                foreach ($files as $file) {
                    $rules = array('images' => 'required|mimes:png,gif,jpeg');
                    $validator = Validator::make(array('images' => $file), $rules);

                    if ($validator->passes()) {
                        $destinationPath1 = public_path('uploads/product_category/image');
                        $destinationPath2 = public_path('uploads/product_category/thumb');
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
            $model = ProductCategory::where('id', '=', $id)->first();

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                $model->update($input);

                #if(ProductCategory::create($input_data))
                if ($model->update()) {
                    $product_category_id = $model->id;
                    if ($files != "") {
                        foreach ($images_name as $image_name) {
                            $input_image = '/uploads/product_category/image' . '/' . $image_name;
                            $input_thumb = '/uploads/product_category/thumb' . '/' . $image_name;

                            $model2 = new ProductCategoryImage();
                            $model2->product_cat_id = $product_category_id;
                            $model2->image = $input_image;
                            $model2->thumb = $input_thumb;
                            $model2->alt = $title;
                            $model2->title = $title;
                            $model2->status = 'active';
                            $model2->updated_by = 0;

                            $model2->save();

                            ProductCategoryImage::boot();

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
                //AdminLogFileHelper::log_info('store-product-category', 'Successfully Added', ['Product Category Name '.$input_data['title']]);
                Session::flash('message', 'Successfully Updated!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                //AdminLogFileHelper::log_error('store-product-category', $e->getMessage(), ['Product Category Name'.$input_data['title']]);
                Session::flash('danger', $e->getMessage());

            }

        }

        return redirect()->route('admin.index.product.category');
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
            $model = ProductCategory::where('id',$id)->first();
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
                    $action_name = 'cancel the Product category';
                    $action_url = 'user/delete-product-category';
                    $action_detail = @\Auth::user()->username.' '. 'delete a product category :: '.$model->title;
                    $action_table = 'product_category';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                }

                DB::commit();
                UserLogFileHelper::log_info('delete-product-category', "Successfully Deleted.", ['Product Category '.$model->title]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-product-category', $e->getMessage(), ['Product Category Title '.$model->title]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }


    public function search_product_category()
    {

        $pageTitle = 'Product Category Information';
        $title = Input::get('title');
        $data = ProductCategory::where('title', 'LIKE', '%'.$title.'%')->orWhere('status', 'LIKE', '%'.$title.'%')
            ->orWhere('type', 'LIKE', '%'.$title.'%')->paginate(30);


        //set user activity data
        $action_name = 'search product category';
        $action_url = 'user/search-product-category';
        $action_detail = @\Auth::user()->username.' '. 'search product category by :: '.Input::get('title');
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::product_category.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
        ]);
    }


}