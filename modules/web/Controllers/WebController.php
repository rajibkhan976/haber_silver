<?php

/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/2/16
 * Time: 1:30 PM
 */
namespace Modules\Web\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        exit("OK");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function html()
    {
        $pageTitle = "Welcome to Haber Silver";

        return view('web::layouts.master',[
            'pageTitle'=>$pageTitle
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function web_home_page()
    {
        $pageTitle = "Homepage |  Haber Silver";
        $banner= "banner";

        return view('web::pages.homepage',[
            'pageTitle'=>$pageTitle,
            'banner'=>$banner
        ]);
    }


    public function web_category_list()
    {
        $pageTitle = "Product Category |  Haber Silver";

        return view('web::pages.product_category',[
            'pageTitle'=>$pageTitle
        ]);
    }

    public function web_product_list()
    {
        $pageTitle = "Product List(s) |  Haber Silver";

        return view('web::pages.product_list',[
            'pageTitle'=>$pageTitle
        ]);
    }

    public function web_product_detail()
    {
        $pageTitle = "Product Details |  Haber Silver";

        return view('web::pages.product_detail',[
            'pageTitle'=>$pageTitle
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