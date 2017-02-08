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
use Modules\Admin\Models\Company;
use Image;
use File;


class CompanyController extends Controller
{

    protected $image_path;
    protected $thumb_path;
    protected $image_relative_path;
    protected $thumb_relative_path;


    public function __construct()
    {
        $this->image_path = public_path('uploads/company/letter_head_image');
        $this->thumb_path = public_path('uploads/company/letter_head_thumb');
        $this->image_relative_path = '/uploads/company/letter_head_image';
        $this->thumb_relative_path = '/uploads/company/letter_head_thumb';

    }






    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Company List";       
        $name = strtolower(Input::get('name'));
        $data = Company::where('name', 'LIKE', '%'.$name.'%')->orderBy('id', 'DESC')->paginate(30);


        //set data
        $action_name = 'Company index';
        $action_url = 'admin/company';
        $action_detail = @\Auth::user()->username.' '. 'View all list of permission ';
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::company.index', [
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
    public function store_company(Requests\CompanyRequest $request)
    {
        $input = $request->all();

        $company_name=strtolower($input['name']);
        $data= Company::where('name', '=', $company_name)->get();      

        if( count($data) <=0)
        {        
            //$input['slug'] = str_slug(strtolower($input['title']));

                   $this->validate($request, [
                        'letter_head_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                    ]);

                    $image = $request->file('letter_head_image');
                    $imagename = $company_name.'.'.$image->getClientOriginalExtension();  

                    $destinationPath1 = $this->image_path;
                    $destinationPath2 = $this->thumb_path;

                    $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
                        DirectoryCheckPermission::is_dir_set_permission($this->image_path);
                        DirectoryCheckPermission::is_dir_set_permission($this->thumb_path);
                    $thumb_img->save($destinationPath2.'/'.$imagename,100);
                    $image->move($destinationPath1, $imagename);


            $input_data = [
                    'name'              =>  strtolower($input['name']),
                    'description'       =>  $input['description'],
                    'approved_product'  =>  $input['approved_product'],
                    'price_level_one'   =>  $input['price_level_one'],
                    'price_level_two'   =>  $input['price_level_two'],
                    'discount_a'        =>  $input['discount_a'],
                    'discount_b'        =>  $input['discount_b'],
                    'discount_c'        =>  $input['discount_c'],
                    'mark_up_level_one' =>  $input['mark_up_level_one'],
                    'mark_up_level_two' =>  $input['mark_up_level_two'],
                    'mark_up_a'         =>  $input['mark_up_a'],
                    'mark_up_b'         =>  $input['mark_up_b'],
                    'mark_up_c'         =>  $input['mark_up_c'],
                    'letter_head_image' =>  $this->image_relative_path .'/'.$imagename,
                    'letter_head_thumb' =>  $this->thumb_relative_path .'/'.$imagename,
                    'letter_head_text'  =>  $input['letter_head_text'],
                    'letter_head_footer'=>  $input['letter_head_footer'],
                    'status'            =>  $input['status'],
                    'updated_by'        =>  0,
                ];

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if(Company::create($input_data))
                {
                    //set user activity data
                    $action_name = 'create a role';
                    $action_url = 'user/store-role';
                    $action_detail = @\Auth::user()->username.' '. 'create a role :: '.@$input['name'];
                    $action_table = 'roles';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('store-company', 'Successfully Added', ['Company Name '.$input_data['name']]);
                Session::flash('message', 'Successfully added!');
                
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-company', $e->getMessage(), ['Company Name'.$input_data['name']]);
                Session::flash('danger', $e->getMessage());
          
            }


        }else{
            Session::flash('info', 'This Company already added!');

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
        $pageTitle = 'View Company Informations';
        $data = Company::where('id',$id)->first();


        //set user activity data
        $action_name = 'View Company';
        $action_url = 'user/view-company';
        $action_detail = @\Auth::user()->username.' '. 'view company by :: '.@$data->title;
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::company.view', [
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
        $pageTitle = "Update Company Informations";              
        $data = Company::where('id',$id)->first();
        $edit_cons = 'edit';

        //set user activity data
        $action_name = 'Edit Company';
        $action_url = 'admin/edit-company';
        $action_detail = @\Auth::user()->username.' '. 'edit company by :: '.@$data->name;
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::company.update', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
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
    public function update(Requests\CompanyRequest $request, $id)
    {
        $input = $request->all();         
        $company_name = strtolower($input['name']);
        $company_name_query = DB::table('company')->select('name')->where('id',$id)->first();
        $pre_company_name = $company_name_query->name;     

        $this->validate($request, [
                    'letter_head_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                ]);

        $image = $request->file('letter_head_image'); 
             
        /*...................................................................*/
        if($image != null){           

            $imagename = $company_name.'.'.$image->getClientOriginalExtension();

                //For Save image & thumb name into database
                $letter_head_image = $this->image_relative_path .'/'.$imagename;
                $letter_head_thumb = $this->thumb_relative_path .'/'.$imagename;
                /*---------------------------------------------------------------------*/
            $destinationPath1 = $this->image_path;
            $destinationPath2 = $this->thumb_path;
            
            File::Delete($destinationPath1.'/'.$imagename);
            File::Delete($destinationPath1.'/'.$imagename);
            $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
            $thumb_img->save($destinationPath2.'/'.$imagename,100);
            $image->move($destinationPath1, $imagename);

        }else{
           $image_query = DB::table('company')->select('letter_head_image','letter_head_thumb')->where('id',$id)->first();                       
           $letter_head_image = $image_query->letter_head_image;
           $letter_head_thumb = $image_query->letter_head_thumb;                
        }  
        /*.............................Updated Data......................................*/
        $input_data = [
                        'name'              =>  strtolower($input['name']),
                        'description'       =>  $input['description'],
                        'approved_product'  =>  $input['approved_product'],
                        'price_level_one'   =>  $input['price_level_one'],
                        'price_level_two'   =>  $input['price_level_two'],
                        'discount_a'        =>  $input['discount_a'],
                        'discount_b'        =>  $input['discount_b'],
                        'discount_c'        =>  $input['discount_c'],
                        'mark_up_level_one' =>  $input['mark_up_level_one'],
                        'mark_up_level_two' =>  $input['mark_up_level_two'],
                        'mark_up_a'         =>  $input['mark_up_a'],
                        'mark_up_b'         =>  $input['mark_up_b'],
                        'mark_up_c'         =>  $input['mark_up_c'],
                        'letter_head_image' =>  $letter_head_image,
                        'letter_head_thumb' =>  $letter_head_thumb,
                        'letter_head_text'  =>  $input['letter_head_text'],
                        'letter_head_footer'=>  $input['letter_head_footer'],
                        'status'            =>  $input['status'],
                     ];
       /*...................................................................*/
              

        if($pre_company_name != $company_name)
            {

                $hascompany = DB::table('company')->where('name', $company_name)->first();
                   /*...................................................................*/
                    if( count($hascompany)<=0)
                        {                    

                            $model = Company::where('id',$id)->first();
                            DB::beginTransaction();
                            try {
                                $model->update($input);
                                DB::commit();
                                UserLogFileHelper::log_info('update-company', 'Successfully updated.', ['Company Name '.$input['name']]);
                                Session::flash('message', 'Successfully added!');

                            }catch (\Exception $e) {
                                //If there are any exceptions, rollback the transaction`
                                DB::rollback();
                                UserLogFileHelper::log_error('update-company', $e->getMessage(), ['Company Name '.$input['name']]);
                                Session::flash('danger', $e->getMessage());
                            }
                        }
                    else
                        {
                            Session::flash('info', 'This company already added!');
                        }
                   /*...................................................................*/

            }else{
                    /*...................................................................*/
                    $model = Company::where('id',$id)->first();
                    DB::beginTransaction();
                    try {
                        $model->update($input_data);
                        DB::commit();
                        UserLogFileHelper::log_info('update-company', 'Successfully updated.', ['Company Name '.$input['name']]);
                        Session::flash('message', 'Successfully Updated!');


                    }catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                        DB::rollback();
                        UserLogFileHelper::log_error('update-company', $e->getMessage(), ['Company Name '.$input['name']]);
                        Session::flash('danger', $e->getMessage());
                    }
                    /*...................................................................*/    
            }


         

        //set user activity data
        $action_name = 'Update Company';
        $action_url = 'admin/update-company';
        $action_detail = @\Auth::user()->username.' '. 'update company by :: '.@$input['name'];
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

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
            $model = Company::where('id',$id)->first();
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
                    $action_name = 'cancel the company';
                    $action_url = 'user/delete-company';
                    $action_detail = @\Auth::user()->username.' '. 'create a company :: '.$model->name;
                    $action_table = 'company';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                }

                DB::commit();
                UserLogFileHelper::log_info('delete-company', "Successfully Deleted.", ['Company Name '.$model->name]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-role', $e->getMessage(), ['Role Title '.$model->name]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }


    public function search_company()
    {

        $pageTitle = 'Company Information';
        $name = Input::get('name');
        $data = Company::where('name', 'LIKE', '%'.$name.'%')->orWhere('status', 'LIKE', '%'.$name.'%')->paginate(30);
        
           
        //set user activity data
        $action_name = 'search company';
        $action_url = 'user/search-company';
        $action_detail = @\Auth::user()->username.' '. 'search company by :: '.Input::get('name');
        $action_table = 'company';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::company.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            ]);
    }


}