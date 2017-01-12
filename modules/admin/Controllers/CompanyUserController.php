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
use Modules\Admin\Models\CompanyUser;
use Modules\Admin\Models\Company;
use App\User;

class CompanyUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pageTitle = "Company User";       
        $title = strtolower(Input::get('title'));
        $data = CompanyUser::join('users','company_users.users_id','=','users.id') 
                           ->join('company','company_users.company_id','=','company.id')
                           ->select(['users.first_name','company.name','company_users.status'])
                           ->where('company.name', 'LIKE', '%'.$title.'%')
                           ->orderBy('company_users.id', 'DESC')
                           ->paginate(30);
      
        //set data
        $action_name = 'company user index';
        $action_url = 'admin/company-user';
        $action_detail = @\Auth::user()->username.' '. 'View all list of company user';
        $action_table = 'company_users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::company_user.index', [
            'data' => $data,           
            'pageTitle'=> $pageTitle,            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search_company_user()
    {

        $pageTitle = 'Company User Information';
        $title = strtolower(Input::get('title'));
        $data = CompanyUser::join('users','company_users.users_id','=','users.id') 
                           ->join('company','company_users.company_id','=','company.id')
                           ->select(['users.first_name','company.name','company_users.status'])
                           ->where('company.name', 'LIKE', '%'.$title.'%')
                           ->orwhere('users.first_name', 'LIKE', '%'.$title.'%')
                           ->orderBy('company_users.id', 'DESC')
                           ->paginate(30);        
     
        //set user activity data
        $action_name = 'company user';
        $action_url = 'user/search-company-user';
        $action_detail = @\Auth::user()->username.' '. 'search company user by :: '.Input::get('title');
        $action_table = 'company_users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::company_user.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            ]);
    }

}