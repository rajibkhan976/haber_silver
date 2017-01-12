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
use Modules\Admin\Models\ImageSlider;
use Image;
use File;


class ImageSliderController extends Controller
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
        $this->image_path = public_path('uploads/image_slider/image');
        $this->thumb_path = public_path('uploads/image_slider/thumb');
        $this->image_relative_path = '/uploads/image_slider/image';
        $this->thumb_relative_path = '/uploads/image_slider/thumb';
    }

    public function index()
    {
        $pageTitle = "Image Slider List";
        $title = strtolower(Input::get('title'));
        $data = ImageSlider::where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'DESC')->paginate(30);

        //set data
        $action_name = 'Image Slider index';
        $action_url = 'admin/image-slider';
        $action_detail = @\Auth::user()->username . ' ' . 'View all list of Image slider ';
        $action_table = 'image_slider';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::image_slider.index', [
            'data' => $data,
            'pageTitle' => $pageTitle,

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_image_slider(Requests\ImageSliderRequest $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $input = $request->all();
        $image_title = strtolower($input['title']);
        $input['slug'] = str_slug(strtolower($input['title']));
        $data = ImageSlider::where('slug', $input['slug'])->exists();
        if (!$data) {
            $image = $request->file('image');
            $imagetitle = str_replace(' ', '-', $image_title . '.' . $image->getClientOriginalExtension());

            $input_data = [
                'title' => $input['title'],
                'slug' => strtolower($input['slug']),
                'caption' => $input['caption'],
                'route' => $input['route'],
                'order' => $input['order'],
                'image' => $this->image_relative_path . '/' . $imagetitle,
                'thumb' => $this->thumb_relative_path . '/' . $imagetitle,
                'short_description' => $input['short_description'],
                'status' => $input['status'],
                'updated_by' => 0,
            ];

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if (ImageSlider::create($input_data)) {
                    $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
                    $thumb_img->save($this->thumb_path . '/' . $imagetitle, 100);
                    $image->move($this->image_path, $imagetitle);
                    //set user activity data
                    $action_name = 'create a image slider';
                    $action_url = 'admin/image-slider';
                    $action_detail = @\Auth::user()->username . ' ' . 'create a image slider :: ' . @$input['title'];
                    $action_table = 'image_slider';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();

                UserLogFileHelper::log_info('store-image-slider', 'Successfully Added', ['Image Slider Title ' . $input_data['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('store-image-slider', $e->getMessage(), ['Image Slider Title' . $input_data['title']]);
                Session::flash('danger', $e->getMessage());

            }


        } else {
            Session::flash('info', 'This Image Slider already added!');

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
        $pageTitle = 'View Image Slider Informations';
        $data = ImageSlider::where('id', $id)->first();

        //dd($data);

        //set user activity data
        $action_name = 'View Image slider';
        $action_url = 'admin/view-image-slider';
        $action_detail = @\Auth::user()->username . ' ' . 'view an image slider, title :: ' . @$data->title;
        $action_table = 'image slider';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::image_slider.view', [
            'data' => $data,
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
        $pageTitle = "Update Image Slider Informations";
        $data = ImageSlider::where('id', $id)->first();

        //set user activity data
        $action_name = 'Edit Image Slider';
        $action_url = 'admin/edit-image-slider';
        $action_detail = @\Auth::user()->username . ' ' . 'edit image slider, title :: ' . @$data->title;
        $action_table = 'image_slider';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::image_slider.update', [
            'data' => $data,
            'pageTitle' => $pageTitle
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ImageSliderRequest $request, $id)
    {
        $input = $request->all();
        $input['slug'] = str_slug(strtolower($input['title']));
        $imagesModel = ImageSlider::where('id', $id)->first();
        $image = $request->file('image');
        if (isset($imagesModel) && count($imagesModel) == 1) {
            if ($image != null) {
                $imagetitle = str_replace(' ', '-', $input['title'] . '.' . $image->getClientOriginalExtension());
                //For Save image & thumb name into database
                $imagename = $this->image_relative_path . '/' . $imagetitle;
                $thumbname = $this->thumb_relative_path . '/' . $imagetitle;

                $input['image'] = $imagename;
                $input['thumb'] = $thumbname;
                /*---------------------------------------------------------------------*/
            } else {
                unset($input['image']);
            }

            DB::beginTransaction();
            try {
                $result = $imagesModel->update($input);
                DB::commit();
                if ($result) {
                    if ($image != null) {
                        File::Delete($imagesModel->image);
                        File::Delete($imagesModel->thumb);
                        $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
                        $thumb_img->save($this->thumb_path . '/' . $imagetitle, 100);
                        $image->move($this->image_path, $imagetitle);
                    }
                }
                UserLogFileHelper::log_info('update-image-slider', 'Successfully updated.', ['Slider Image Title ' . $input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('update-image-slider', $e->getMessage(), ['Image Slider Title ' . $input['title']]);
                Session::flash('danger', $e->getMessage());
            }
        }

        //set user activity data
        $action_name = 'Update Image slider';
        $action_url = 'admin/update-image-slider';
        $action_detail = @\Auth::user()->username . ' ' . 'updates image slider, title :: ' . @$input['title'];
        $action_table = 'image_slider';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
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
            $model = ImageSlider::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($model->status == 'active') {
                    $model->status = 'cancel';
                } else {
                    $model->status = 'active';
                }

                if ($model->save()) {
                    //set data
                    $action_name = 'cancel the image slider';
                    $action_url = 'admin/delete-image-slider';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes an image slider, title :: ' . $model->title;
                    $action_table = 'image_slider';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                UserLogFileHelper::log_info('delete-image-slider', "Successfully Deleted.", ['Slider Image Title ' . $model->title]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-image-slider', $e->getMessage(), ['Slider Image Title ' . $model->title]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function search_image_slider()
    {
        $pageTitle = 'Image Slider Information';
        $title = Input::get('title');
        $data = ImageSlider::where('title', 'LIKE', '%' . $title . '%')->orWhere('caption', 'LIKE', '%' . $title . '%')->orWhere('short_description', 'LIKE', '%' . $title . '%')->paginate(30);

        //set user activity data
        $action_name = 'search image slider';
        $action_url = 'admin/search-image-slider';
        $action_detail = @\Auth::user()->username . ' searches image slider';
        $action_table = 'image_slider';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::image_slider.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
        ]);
    }


}