<?php



namespace Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Models\Company;
use Modules\Admin\Models\CompanyProduct;

class CompanyProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Company Products";
        
        $data = DB::table('company_product')
            ->join('company', 'company.id', '=', 'company_product.company_id')
            ->join('product', 'product.id', '=', 'company_product.product_id')
            ->select('company_product.id as id', 'company_product.status as status', 
                'company.id as c_id', 'company.name as c_name',
                'product.id as p_id', 'product.product_code as p_code')
            ->paginate(30);

        $company_query = DB::table('company')->select('id', 'name')->get();
        $product_query = DB::table('product')->select('id', 'product_code')->get();

        
        return view('admin::company_product.index', [
            'pageTitle'=>$pageTitle,
            'data'=>$data,
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

}