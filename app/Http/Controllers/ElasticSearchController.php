<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\GetFilesFromDirectory;
use App\Http\Helpers\PdfToText;
use Elasticsearch\ClientBuilder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ElasticSearchController extends Controller
{
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
                            'field' => 'content',
                            'indexed_chars' => -1
                        ]
                    ],

                ]
            ],

        ];

        return $client->ingest()->putPipeline($params);
    }


    // Index A Document

    public function ingest_processor_indexing()
    {

        /*$files_dir = public_path()."/uploads/files";
        $all_f = GetFilesFromDirectory::getDirContents($files_dir);
        foreach($all_f as $value){
            #$path = $value['image']['name'];
            $ext = pathinfo($value, PATHINFO_EXTENSION);
            echo "<pre>";
            echo $ext;
            echo "<pre>";

        }*/

        $client = $this->client;
        $fullfile = public_path().'/uploads/files/bower.pdf';
        $data = base64_encode(file_get_contents($fullfile));

        $params = [
            'index' => 'ingest_index',
            'type'  => 'attachment',
            'id'    => 'document_id',
            'pipeline' => 'attachment',  // <----- here
            'body'  => [
                'content' => $data,
                'file_path' =>$fullfile,
            ]
        ];
        for($i = 0; $i < 100; $i++) {

            $params['body'][] = [
                'my_field' => 'my_value',
                'second_field' => 'some more values'
            ];
        }

        return $client->index($params);
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
                        'content' => $query,
                    ]
                ],
            ],
            'size' => 30,
            'from' => 30,
        ];

        $response = $client->search($params);
        return $response['hits']['hits'];
    }


    // Get a document

    public function ingest_processor_get_data()
    {
        $client = $this->client;
        $params = [
            'index' => 'ingest_index',
            'type' => 'attachment',
            'id' => 'document_id'
        ];

        $response = $client->get($params);
        return $response;

    }


    // Delete a Document

    public function ingest_processor_delete_data()
    {
        $client = $this->client;
        $params = [
            'index' => 'ingest_index',
            'type' => 'attachment',
            'id' => 'document_id'
        ];

        $response = $client->delete($params);
        return $response;

    }
}
