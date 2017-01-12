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
use Modules\Admin\Models\TradeShow;
use Image;
use File;


class TradeShowController extends Controller
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
        $this->image_path = public_path('uploads/trade_show/image');
        $this->thumb_path = public_path('uploads/trade_show/thumb');
        $this->image_relative_path = '/uploads/trade_show/image';
        $this->thumb_relative_path = '/uploads/trade_show/thumb';
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

        $pageTitle = "Trade Show List";
        $data = TradeShow::orderBy('id', 'DESC')->paginate(30);

        //set data
        $action_name = 'Trade Show index';
        $action_url = 'admin/trade-show';
        $action_detail = @\Auth::user()->username . ' ' . 'View all list of Trade Show ';
        $action_table = 'trade_show';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::trade_show.index', [
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
    public function store_trade_show(Requests\TradeShowRequest $request)
    {

        $input = $request->all();
        $input['slug'] = str_slug(strtolower($input['title']));
        $data = TradeShow::where('slug', $input['slug'])->exists();
        $input['image'] = '';
        $input['thumb'] = '';
        if (!$data) {
            $image = $request->file('image');
            if ($image != null) {
                $image_title = strtolower($input['title']);
                $imagetitle = str_replace(' ', '-', $image_title . '.' . $image->getClientOriginalExtension());
                $input['image'] = $this->image_relative_path . '/' . $imagetitle;
                $input['thumb'] = $this->thumb_relative_path . '/' . $imagetitle;

            }

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if (TradeShow::create($input)) {
                    if ($image != null) {
                        $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
                        $thumb_img->save($this->thumb_path . '/' . $imagetitle, 100);
                        $image->move($this->image_path, $imagetitle);
                    }
                    //set user activity data
                    $action_name = 'create a trade show Item';
                    $action_url = 'admin/trade-show';
                    $action_detail = @\Auth::user()->username . ' ' . 'create a trade show Item, title :: ' . @$input['title'];
                    $action_table = 'trade_show';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();

                UserLogFileHelper::log_info('store-trade-show', 'Successfully Added', ['a trade show Item Title ' . $input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('store-trade-show', $e->getMessage(), ['Trade show Title' . $input_data['title']]);
                Session::flash('danger', $e->getMessage());

            }


        } else {
            Session::flash('info', 'This trade show Item already added!');

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
        $pageTitle = 'View trade show Informations';
        $data = TradeShow::where('id', $id)->first();

        //dd($data);

        //set user activity data
        $action_name = 'View Trade Show';
        $action_url = 'admin/view-trade-show';
        $action_detail = @\Auth::user()->username . ' ' . 'views a Trade Showe, title :: ' . @$data->title;
        $action_table = 'trade_show';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::trade_show.view', [
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
        $pageTitle = "Update Trade Show Informations";
        $data = TradeShow::where('id', $id)->first();

        //set user activity data
        $action_name = 'Edit Trade Show ';
        $action_url = 'admin/edit-trade-show';
        $action_detail = @\Auth::user()->username . ' ' . 'edit trade show , title :: ' . @$data->title;
        $action_table = 'trade_show';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::trade_show.update', [
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
    public function update(Requests\TradeShowRequest $request, $id)
    {
        $input = $request->all();
        $input['slug'] = str_slug(strtolower($input['title']));
        $imagesModel = TradeShow::where('id', $id)->first();
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
                UserLogFileHelper::log_info('update-trade-show', 'Successfully updated.', ['Trade Show Item Title ' . $input['title']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('update-trade-show', $e->getMessage(), ['Trade Show Item Title ' . $input['title']]);
                Session::flash('danger', $e->getMessage());
            }
        }

        //set user activity data
        $action_name = 'Update Trade Show Item';
        $action_url = 'admin/update-trade-show';
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
            $model = TradeShow::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($model->status == 'active') {
                    $model->status = 'cancel';
                } else {
                    $model->status = 'active';
                }

                if ($model->save()) {
                    //set data
                    $action_name = 'cancel the trade show item';
                    $action_url = 'admin/delete-trade-show';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes an trade show item, title :: ' . $model->title;
                    $action_table = 'trade_show';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                UserLogFileHelper::log_info('delete-trade-show', "Successfully Deleted.", ['Trade Show Title ' . $model->title]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-trade-show', $e->getMessage(), ['Trade Show Item Title ' . $model->title]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function search_reconditioning()
    {
        $pageTitle = 'Trade Show Information';
        $title = Input::get('title');
        $data = TradeShow::where('title', 'LIKE', '%' . $title . '%')->orWhere('short_description', 'LIKE', '%' . $title . '%')->paginate(30);

        //set user activity data
        $action_name = 'search trade show item';
        $action_url = 'admin/search-trade-show';
        $action_detail = @\Auth::user()->username . ' searches trade show item';
        $action_table = 'trade_show';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::trade_show.index', [
            'pageTitle' => $pageTitle,
            'data' => $data,
        ]);
    }


}