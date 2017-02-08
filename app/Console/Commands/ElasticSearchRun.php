<?php

namespace App\Console\Commands;

use App\Http\Helpers\GetFilesFromDirectory;
use Illuminate\Console\Command;

class ElasticSearchRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elastic Search :: Index All Files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = \Elasticsearch\ClientBuilder::create()->build();;

        $files_dir = public_path()."/uploads/files";
        $all_files =GetFilesFromDirectory::getDirContents($files_dir);

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

        $res = $client->bulk($params);

        $this->info("Successfully Indexed all Files!");
    }
}
