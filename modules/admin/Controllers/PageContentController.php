<?php

namespace Modules\Admin\Controllers;

use Backpack\PageManager\app\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Helpers\ActivityLogs;
use App\Helpers\UserLogFileHelper;
use Modules\Admin\Models\PageContent;
use Image;
use File;


class PageContentController extends Controller
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
        $this->image_path = public_path('uploads/page_content/image');
        $this->thumb_path = public_path('uploads/page_content/thumb');
        $this->image_relative_path = '/uploads/page_content/image';
        $this->thumb_relative_path = '/uploads/page_content/thumb';
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

        $pageTitle = "Page Content List";
        $data = PageContent::orderBy('id', 'DESC')->paginate(30);

        //set data
        $action_name = 'Page Content index';
        $action_url = 'admin/page-content';
        $action_detail = @\Auth::user()->username . ' ' . 'View all list of Page content ';
        $action_table = 'page_content';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::page_content.index', [
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
    public function store_page_content(Requests\PageContentRequest $request)
    {

        $input = $request->all();
        $image = $request->file('image');
        $input['image'] = '';
        $input['thumb'] = '';
        if ($image != null) {
            $image_title = strtolower($input['type']) . '_' . time();
            $imagetitle = str_replace(' ', '-', $image_title . '.' . $image->getClientOriginalExtension());
            $input['image'] = $this->image_relative_path . '/' . $imagetitle;
            $input['thumb'] = $this->thumb_relative_path . '/' . $imagetitle;
        }
        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            if (PageContent::create($input)) {
                if ($image != null) {
                    $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
                    $thumb_img->save($this->thumb_path . '/' . $imagetitle, 100);
                    $image->move($this->image_path, $imagetitle);
                }
                //set user activity data
                $action_name = 'create a page content';
                $action_url = 'admin/page-content';
                $action_detail = @\Auth::user()->username . ' ' . 'create a page content, type :: ' . @$input['type'];
                $action_table = 'page_content';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
            }

            DB::commit();

            UserLogFileHelper::log_info('store-page-content', 'Successfully Added', ['a page content, Type::  ' . $input['type']]);
            Session::flash('message', 'Successfully added!');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            UserLogFileHelper::log_error('store-page-content', $e->getMessage(), ['Page content Type' . $input['type']]);
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
        $pageTitle = 'View Page Content Informations';
        $data = PageContent::where('id', $id)->first();

        //dd($data);

        //set user activity data
        $action_name = 'View Page Content';
        $action_url = 'admin/view-page-content';
        $action_detail = @\Auth::user()->username . ' ' . 'view a page content, type :: ' . @$data->type;
        $action_table = 'Page Content';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::page_content.view', [
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
        $pageTitle = "Update Page Content Informations";
        $data = PageContent::where('id', $id)->first();

        //set user activity data
        $action_name = 'Edit Page Content ';
        $action_url = 'admin/edit-page-content';
        $action_detail = @\Auth::user()->username . ' ' . 'edit page content , type :: ' . @$data->type;
        $action_table = 'page_content';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::page_content.update', [
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
    public function update(Requests\PageContentRequest $request, $id)
    {
        $input = $request->all();
        $imagesModel = PageContent::where('id', $id)->first();
        $image = $request->file('image');
        if (isset($imagesModel) && count($imagesModel) == 1) {
            if ($image != null) {
                $imagetitle = str_replace(' ', '-', $input['type'] . '_' . time() . '.' . $image->getClientOriginalExtension());
                //For Save image & thumb name into database
                $imagename = $this->image_relative_path . '/' . $imagetitle;
                $thumbname = $this->thumb_relative_path . '/' . $imagetitle;

                $input['image'] = $imagename;
                $input['thumb'] = $thumbname;
                /*---------------------------------------------------------------------*/
            } else {
                unset($input['image']);
            }
            //  dd($input);
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
                UserLogFileHelper::log_info('update-page-content', 'Successfully updated.', ['Page Content Type ' . $input['type']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('update-page-content', $e->getMessage(), ['Page Content Type ' . $input['type']]);
                Session::flash('danger', $e->getMessage());
            }
        }

        //set user activity data
        $action_name = 'Update Page Content';
        $action_url = 'admin/update-page-content';
        $action_detail = @\Auth::user()->username . ' ' . 'updates page content, Type :: ' . @$input['type'];
        $action_table = 'page_content';
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
            $model = PageContent::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($model->status == 'active') {
                    $model->status = 'cancel';
                } else {
                    $model->status = 'active';
                }

                if ($model->save()) {
                    //set data
                    $action_name = 'cancel the page content';
                    $action_url = 'admin/delete-page-content';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes an page content, type :: ' . $model->type;
                    $action_table = 'page_content';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                UserLogFileHelper::log_info('delete-page-content', "Successfully Deleted.", ['Page Content Type ' . $model->type]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-page-content', $e->getMessage(), ['Page content type ' . $model->type]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function search_page_content()
    {
        $pageTitle = 'Page Content Information';
        $description = Input::get('short_description');

        $data = PageContent::where('short_description', 'LIKE', '%' . $description . '%')->orWhere('long_description', 'LIKE', '%' . $description . '%')->paginate(30);

        //set user activity data
        $action_name = 'search page content item';
        $action_url = 'admin/search-page-content';
        $action_detail = @\Auth::user()->username . ' searches page content item';
        $action_table = 'page_content';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::page_content.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
        ]);
    }


}