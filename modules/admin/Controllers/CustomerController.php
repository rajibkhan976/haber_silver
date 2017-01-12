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
use Modules\Admin\Models\Company;
use Modules\Admin\Models\Customer;
use App\Http\Requests\CustomerRequest;


class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Customer List";


       // $title = strtolower(Input::get('title'));
        // $data = Customer::where('first_name', 'LIKE', '%'.$title.'%')->orderBy('id', 'DESC')->paginate(30);

        $data = DB::table('customer')
            ->join('company', 'company.id', '=', 'customer.company_id')
            ->select('customer.*', 'company.name')
            ->get();
        $company_data = DB::table('company')->get();

        //set data
        $action_name = 'Customer index';
        $action_url = 'admin/customer';
        $action_detail = @\Auth::user()->username.' '. 'View customer list';
        $action_table = 'customer';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::customer.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'company_data' => $company_data,

        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_customer(Requests\CustomerRequest $request)
    {
            $input = $request->all();


            $input_data = [
                    'first_name'        =>  $input['first_name'],
                    'last_name'         =>  $input['last_name'],
                    'company_id'        =>  $input['company_id'],
                    'address_one'       =>  $input['address_one'],
                    'address_two'       =>  $input['address_two'],
                    'address_three'     =>  $input['address_three'],
                    'city'              =>  $input['city'],
                    'state'             =>  $input['state'],
                    'zip'               =>  $input['zip'],
                    'country'           =>  $input['country'],
                    'phone_number'      =>  $input['phone_number'],
                    'fax_number'        =>  $input['fax_number'],
                    'email_one'         =>  $input['email_one'],
                    'email_two'         =>  $input['email_two'],
                    'email_three'       =>  $input['email_three'],
                    'email_four'        =>  $input['email_four'],
                    'notes'             =>  $input['notes'],
                    'status'            =>  $input['status'],
                    'updated_by'        =>  0,
                ];

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            if(Customer::create($input_data))
            {
                //set user activity data
                $action_name = 'create a customer';
                $action_url = 'user/store-customer';
                $action_detail = @\Auth::user()->username.' '. 'create a customer :: '.@$input['first_name'] .@$input['last_name'];
                $action_table = 'customer';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
            }

            DB::commit();
            //AdminLogFileHelper::log_info('store-customer', 'Successfully Added', ['Customer Name '.$input_data['first_name'] .@$input['last_name']]);
            Session::flash('message', 'Successfully added!');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            //AdminLogFileHelper::log_error('store-company', $e->getMessage(), ['Customer Name'.@$input_data['first_name'] .@$input_data['last_name']]);
            Session::flash('danger', $e->getMessage());

        }


        return redirect()->back();
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'View Customer Informations';
        //$data = Customer::where('id',$id)->first();
        $data = DB::table('customer')
            ->join('company', 'company.id', '=', 'customer.company_id')
            ->select('customer.*', 'company.name')
            ->where('customer.id',$id)->first();

        //set user activity data
        $action_name = 'View Customer';
        $action_url = 'user/view-customer';
        $action_detail = @\Auth::user()->username.' '. 'view customer by :: '.@$data->title;
        $action_table = 'customer';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::customer.view', [
            'data' => $data, 
            'pageTitle'=> $pageTitle
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
        $pageTitle = "Update Customer Informations";
        //$data = Customer::where('id',$id)->first();
        $data = DB::table('customer')
            ->join('company', 'company.id', '=', 'customer.company_id')
            ->select('customer.*', 'company.id as co_id', 'company.name')
            ->where('customer.id',$id)->first();

        //set user activity data
        $action_name = 'Edit customer';
        $action_url = 'admin/edit-customer';
        $action_detail = @\Auth::user()->username.' '. 'edit customer by :: '.@$data->first_name .@$data->last_name;
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::customer.update', [
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
    public function update(Requests\CustomerRequest $request, $id)
    {
        $input = $request->all();
        $input_data = [
            'first_name'        =>  $input['first_name'],
            'last_name'         =>  $input['last_name'],
            'company_id'        =>  $input['company_id'],
            'address_one'       =>  $input['address_one'],
            'address_two'       =>  $input['address_two'],
            'address_three'     =>  $input['address_three'],
            'city'              =>  $input['city'],
            'state'             =>  $input['state'],
            'zip'               =>  $input['zip'],
            'country'           =>  $input['country'],
            'phone_number'      =>  $input['phone_number'],
            'fax_number'        =>  $input['fax_number'],
            'email_one'         =>  $input['email_one'],
            'email_two'         =>  $input['email_two'],
            'email_three'       =>  $input['email_three'],
            'email_four'        =>  $input['email_four'],
            'notes'             =>  $input['notes'],
            'status'            =>  $input['status'],
            'updated_by'        =>  0,
        ];

        /*...................................................................*/
        $model = Customer::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $model->update($input_data);
            DB::commit();
            //AdminLogFileHelper::log_info('update-customer', 'Successfully updated.', ['Customer Name '.@$input['first_name'] .@$input['last_name']]);
            Session::flash('message', 'Successfully Updated!');


            if($model->update($input_data)){
                //set user activity data
                $action_name = 'Update Customer';
                $action_url = 'admin/update-customer';
                $action_detail = @\Auth::user()->username.' '. 'update customer by :: '.@$input['first_name'] .@$input['last_name'];
                $action_table = 'customer';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
            }


        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            //AdminLogFileHelper::log_error('update-customer', $e->getMessage(), ['Customer Name '.@$input['first_name'] .@$input['last_name']]);
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
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
            $model = Customer::where('id',$id)->first();
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
                    $action_name = 'cancel the customer';
                    $action_url = 'user/delete-customer';
                    $action_detail = @\Auth::user()->username.' '. 'create a customer :: '.$model->name;
                    $action_table = 'customer';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                }

                DB::commit();
                //AdminLogFileHelper::log_info('delete-customer', "Successfully Deleted.", ['Customer Name '.$model->first_name .$model->last_name]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                //AdminLogFileHelper::log_error('delete-customer', $e->getMessage(), ['Customer Name '.$model->first_name .$model->last_name]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }


    public function search_customer()
    {

        $pageTitle = 'Customer Information';
        $title = Input::get('title');

        if(isset($title)) {

            $data = DB::table('customer')
                ->join('company', 'company.id', '=', 'customer.company_id')
                ->where('customer.first_name', 'LIKE', '%' . $title . '%')
                ->orWhere('customer.last_name', 'LIKE', '%' . $title . '%')
                ->orWhere('customer.email_one', 'LIKE', '%' . $title . '%')
                ->orWhere('customer.email_two', 'LIKE', '%' . $title . '%')
                ->orWhere('customer.phone_number', 'LIKE', '%' . $title . '%')
                ->orWhere('customer.status', 'LIKE', '%' . $title . '%')
                ->orWhere('company.name', 'LIKE', '%' . $title . '%')
                ->paginate(30);

        }else{
            $data=null;
        }

        //set user activity data
        $action_name = 'search customer';
        $action_url = 'user/search-customer';
        $action_detail = @\Auth::user()->username.' '. 'search customer by :: '.Input::get('name');
        $action_table = 'customer';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::customer.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            ]);
    }


}