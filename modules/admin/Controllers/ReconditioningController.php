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
use Modules\Admin\Models\Reconditioning;
use Image;
use File;


class ReconditioningController extends Controller
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
        $this->image_path = public_path('uploads/reconditioning/image');
        $this->thumb_path = public_path('uploads/reconditioning/thumb');
        $this->image_relative_path = '/uploads/reconditioning/image';
        $this->thumb_relative_path = '/uploads/reconditioning/thumb';
    }

    //Get and Post method
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }


    public function index()
    {

        $pageTitle = "Recondition Service List";
        $title = strtolower(Input::get('reconditioning'));
        $data = Reconditioning::orderBy('id', 'DESC')->paginate(30);

        //set data
        $action_name = 'Recondition Service index';
        $action_url = 'admin/reconditioning';
        $action_detail = @\Auth::user()->username . ' ' . 'View all list of Recondition Service ';
        $action_table = 'reconditioning';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::reconditioning.index', [
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
    public function store_reconditioning(Requests\ReconditioningRequest $request)
    {
        $input = $request->all();
        $image_title = strtolower($input['title']);
        $input['slug'] = str_slug(strtolower($input['title']));
        $data = Reconditioning::where('slug', $input['slug'])->exists();
        if (!$data) {
            $image = $request->file('image');
            if ($image != null) {
                $imagetitle = str_replace(' ', '-', $image_title . '.' . $image->getClientOriginalExtension());
                $input['image'] = $this->image_relative_path . '/' . $imagetitle;
                $input['thumb'] = $this->thumb_relative_path . '/' . $imagetitle;
            }
            DB::beginTransaction();
            try {
                if (Reconditioning::create($input)) {
                    if ($image != null) {
                        $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
                        $thumb_img->save($this->thumb_path . '/' . $imagetitle, 100);
                        $image->move($this->image_path, $imagetitle);
                    }
                    //set user activity data
                    $action_name = 'create a reconditioning service Item';
                    $action_url = 'admin/reconditioning';
                    $action_detail = @\Auth::user()->username . ' ' . 'create a reconditioning service Item, title :: ' . @$input['title'];
                    $action_table = 'reconditioning';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                UserLogFileHelper::log_info('store-reconditioning', 'Successfully Added', ['a reconditioning Item Title ' . $input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('store-reconditioning', $e->getMessage(), ['Image Reconditioning service Item Title' . $input['title']]);
                Session::flash('danger', $e->getMessage());
            }

        } else {
            Session::flash('info', 'This reconditioning service Item already added!');

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
        $pageTitle = 'View Reconditioning Service Informations';
        $data = Reconditioning::where('id', $id)->first();

        //dd($data);

        //set user activity data
        $action_name = 'View Reconditioning Service';
        $action_url = 'admin/view-reconditioning';
        $action_detail = @\Auth::user()->username . ' ' . 'view a Reconditioning Service, title :: ' . @$data->title;
        $action_table = 'Reconditioning Service';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::reconditioning.view', [
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
        $pageTitle = "Update Reconditioning Informations";
        $data = Reconditioning::where('id', $id)->first();

        //set user activity data
        $action_name = 'Edit Reconditioning Service ';
        $action_url = 'admin/edit-reconditioning';
        $action_detail = @\Auth::user()->username . ' ' . 'edit reconditioning service , title :: ' . @$data->title;
        $action_table = 'reconditioning';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::reconditioning.update', [
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
    public function update(Requests\ReconditioningRequest $request, $id)
    {
        $input = $request->all();
        $input['slug'] = str_slug(strtolower($input['title']));
        $imagesModel = Reconditioning::where('id', $id)->first();
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
                UserLogFileHelper::log_info('update-reconditioning', 'Successfully updated.', ['Reconditioning Item Title ' . $input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('update-reconditioning', $e->getMessage(), ['Reconditioning Item Title ' . $input['title']]);
                Session::flash('danger', $e->getMessage());
            }
        }

        //set user activity data
        $action_name = 'Update Reconditioning Item';
        $action_url = 'admin/update-reconditioning';
        $action_detail = @\Auth::user()->username . ' ' . 'updates reconditioning item, Title :: ' . @$input['title'];
        $action_table = 'reconditioning';
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
            $model = Reconditioning::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($model->status == 'active') {
                    $model->status = 'cancel';
                } else {
                    $model->status = 'active';
                }

                if ($model->save()) {
                    //set data
                    $action_name = 'cancel the Reconditioning Service';
                    $action_url = 'admin/delete-reconditioning';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes an reconditioning Service item, title :: ' . $model->title;
                    $action_table = 'reconditioning';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                UserLogFileHelper::log_info('delete-reconditioning', "Successfully Deleted.", ['Reconditioning Item Title ' . $model->title]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-reconditioning', $e->getMessage(), ['Reconditioning Item Title ' . $model->title]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function search_reconditioning()
    {
        $pageTitle = 'Reconditioning Service Information';
        $title = Input::get('title');
        $data = Reconditioning::where('title', 'LIKE', '%' . $title . '%')->orWhere('short_description', 'LIKE', '%' . $title . '%')->orWhere('long_description', 'LIKE', '%' . $title . '%')->paginate(30);

        //set user activity data
        $action_name = 'search reconditioning service item';
        $action_url = 'admin/search-reconditioning';
        $action_detail = @\Auth::user()->username . ' searches reconditioning service item';
        $action_table = 'reconditioning';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::reconditioning.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
        ]);
    }


}