<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/23/17
 * Time: 2:29 PM
 */


    /**  Search Page from Admin */

    Route::get('es_search', [
        'as' => 'admin.es_search',
        'uses' => 'AdminController@content_search'
    ]);

    Route::get('es_indexing', [
        'as' => 'admin.es_indexing',
        'uses' => 'AdminController@es_indexing'
    ]);

    Route::post('es_uploads', [
        'as' => 'admin.es_uploads',
        'uses' => 'AdminController@es_uploads'
    ]);

    /**
     *   Elastic Search
     *   and Ingest Processor
     **/

    Route::any('ingest_processor_mapping', [
        'as' => 'ingest_processor_mapping',
        'uses' => 'ElasticSearchController@ingest_processor_mapping'
    ]);

    Route::any('ingest_processor_indexing', [
        'as' => 'admin.ingest_processor_indexing',
        'uses' => 'ElasticSearchController@ingest_processor_indexing'
    ]);

    Route::get('ingest_processor_searching/{query}', [
        'as' => 'ingest_processor_searching',
        'uses' => 'ElasticSearchController@ingest_processor_searching'
    ]);

    Route::get('ingest_processor_get_data', [
        'as' => 'ingest_processor_get_data',
        'uses' => 'ElasticSearchController@ingest_processor_get_data'
    ]);

    Route::get('ingest_processor_delete_data', [
        'as' => 'ingest_processor_delete_data',
        'uses' => 'ElasticSearchController@ingest_processor_delete_data'
    ]);