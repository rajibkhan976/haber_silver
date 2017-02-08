<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/23/17
 * Time: 2:40 PM
 */

namespace Modules\Admin\Controllers;

use App\Http\Helpers\GetFilesFromDirectory;
use App\Http\Helpers\PdfToText;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ElasticSearchController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = \Elasticsearch\ClientBuilder::create()->build();
    }


    // Map a Document

    public function ingest_processor_mapping()
    {
        $client = $this->client;
        $params = [
            'id' => 'attachment',
            'body' => [
                'description' => 'Extract attachment information',
                'processors' => [
                    [
                        'attachment' => [
                            'field' => 'textField',
                            'indexed_chars' => -1
                        ],

                    ],
                ],

            ],

        ];

        return $client->ingest()->putPipeline($params);
    }


    // Index A Document

    public function ingest_processor_indexing()
    {
        $client = $this->client;

        $files_dir = public_path()."/uploads/files";
        $all_files = GetFilesFromDirectory::getDirContents($files_dir);

        for($i = 0;  $i < count($all_files); $i++) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'ingest_index',
                    '_type' => 'attachment',
                    '_id' => $i,
                    'pipeline' => 'attachment',
                ]
            ];

            $fullfile = $all_files[$i];// public_path().'/uploads/files/bower.pdf';
            $data = base64_encode(file_get_contents($fullfile));

            $params['body'][] = [
                'textField' => $data,
                'file_path' =>$fullfile,
            ];
        }

        return $client->bulk($params);


        // Old style
        /*$params = [
            'index' => 'ingest_index',
            'type'  => 'attachment',
            'id'    => 'document_id',
            'pipeline' => 'attachment',  // <----- here
            'body'  => [
                'content' => $data,
                'file_path' =>$fullfile,
            ]
        ];
        return $client->index($params);*/
    }

    /**
     * // Search (DSL)
     * @param $query
     * @return mixed
     */
    public function ingest_processor_searching($query)
    {
        $client = $this->client;
        $params = [
            'index' => 'ingest_index',
            'type' => 'attachment',
            'body' => [
                'query' => [
                    'match' => [
                        'attachment.content' => $query,
                    ]
                ],
            ],
        ];

        $response = $client->search($params);
        return $response['hits']['hits'];
    }


    // Get a document

    public function ingest_processor_get_data()
    {
        // all data :: http://localhost:9200/ingest_index/_search?size=1000&from=0

        $client = $this->client;
        $params = [
            'index' => 'ingest_index',
            'type' => 'attachment',
            'id' => 'document_id',
        ];

        $response = $client->getSource($params);
        return $response;

    }


    // Delete a Document

    public function ingest_processor_delete_data()
    {
        $client = $this->client;
        $params = [
            'index' => 'ingest_index',
            'type' => 'attachment',
        ];

        $response = $client->delete($params);
        return $response;
    }



}