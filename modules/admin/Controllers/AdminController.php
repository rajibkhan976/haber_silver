<?php

/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/2/16
 * Time: 12:40 PM
 */

namespace Modules\Admin\Controllers;

use App\Http\Helpers\GetFilesFromDirectory;
use App\Http\Helpers\Ocr;
use App\Http\Helpers\PdfToText;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use GuzzleHttp\Ring\Client\CurlHandler;
use React\Promise\PromiseInterface;

class AdminController extends Controller
{
    //Get and Post method
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageTitle = "Dashboard | Haber Silver";

        return view('admin::dashboard.dashboard', [
            'pageTitle'=>$pageTitle
        ]);
    }



    // Search
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function content_search()
    {

        $pageTitle = "Full Text Search on PDF / DOCX / TXT";
        $result = array();
        $input = Input::all();

        if(count($input)>0)
        {
            $query= $input['query'];

            $elasticEngine =  new ElasticSearchController();
            $result = $elasticEngine->ingest_processor_searching($query);

            if($result != null)
            {
                return view('admin::elastic_search.search_page', [
                    'data' => $result,
                    'pageTitle'=> $pageTitle,

                ]);

            }else{
                Session::flash('info', 'No Match Found!');
                return redirect()->back();
            }

        }else{
            return view('admin::elastic_search.search_page', [
                'data' => $result,
                'pageTitle'=> $pageTitle,

            ]);
        }

    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function es_uploads()
    {
        $files = Input::file('files');

        if($files != "") {
            foreach ($files as $file)
            {
                $dir = public_path('uploads/files/elastic_search');

                if(!is_dir($dir))
                {
                  File::makeDirectory($dir, 0777, true, true);
                }

                $fileName = $file->getClientOriginalName();
                $file->move($dir, $fileName);
            }
        }

        Session::flash('success', 'Uploaded Successfully!');
        return redirect()->back();

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function es_indexing()
    {
        $elasticEngine =  new ElasticSearchController();
        $result = $elasticEngine->ingest_processor_indexing();
        if($result){
            Session::flash('success', 'Uploaded Successfully!');
        }else{
            Session::flash('info', 'nothing to update!');
        }

        return redirect()->back();

    }
    





}