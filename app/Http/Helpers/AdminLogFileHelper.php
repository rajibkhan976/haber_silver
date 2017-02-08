<?php

/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 12/19/16
 * Time: 12:40 PM
 */

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Monolog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class AdminLogFileHelper
{

    /**
    *  Log file create for user module  
    */
    private static function log_file($label_name = null, $file_name = 'admin_log')
    {
        $log = new Monolog\Logger($label_name);
        $dir = storage_path().'/logs/admin/';

        if(!is_dir($dir))
        {
            File::makeDirectory($dir, 0777, true, true);
        }

        $log->pushHandler(new Monolog\Handler\StreamHandler($dir.$file_name.'-'.date('Y-m-d').'.log'),0777);
        return $log;
    }

    /**
    *  Log Info Message
    */
    public static function log_info($label_name, $message = 'Change', $value = array('value' => 'message'))
    {
        $file_create = AdminLogFileHelper::log_file($label_name);
        if($file_create){
            $file_create->addInfo($message, $value);
        }
    }

    /**
    *  Log Error Message
    */
    public static function log_error($label_name, $message = 'Change', $value = array('value' => 'message'))
    {
        $file_create = AdminLogFileHelper::log_file($label_name);
        if($file_create){
            $file_create->addError($message, $value);
        }
    }
    
    /**
    *  Log Alert Message 
    */
    public function log_alert($label_name, $value = array('value' => 'message'))
    {
        $file_create = $this->log_file($label_name);
        if($file_create){
            $file_create->addInfo('Add Some Info message', $value);
        }
    }

    /**
    *  Log Notice Message
    */
    public function log_notice($label_name, $value = array('value' => 'message'))
    {
        $file_create = $this->log_file($label_name);
        if($file_create){
            $file_create->addInfo('Add Some Info message', $value);
        }
    }


}