<?php
/**
 * Created by PhpStorm.
 * User: anwar
 * Date: 1/10/17
 * Time: 6:53 PM
 */

namespace App\Http\Helpers;
use Illuminate\Support\Facades\File;


class DirectoryCheckPermission
{


    /**
     * @param $directory
     * @return bool
     */
    public static function is_dir_set_permission($directory)
    {
        if(is_dir($directory))
        {
            DirectoryCheckPermission::check_permission($directory);
            return true;
        }
        else
        {
            DirectoryCheckPermission::make_directory($directory);
            return true;
        }

    }

    /**
     * @param $directory
     * @return bool
     */
    protected static function make_directory($directory)
    {
        File::makeDirectory($directory, 0777, true, true);
        return true;
    }

    /**
     * @param $directory
     * @return bool
     */
    protected static function check_permission($directory)
    {
        if(is_writable($directory))
        {
            return true;
        }
        else
        {
            DirectoryCheckPermission::set_permission($directory);
            return true;
        }
    }


    /**
     * @param $dirctory
     * @param $permission
     * @return bool
     */
    protected static function set_permission($directory)
    {
        if(!is_dir($directory))
        {
            File::makeDirectory($directory, 0777, true, true);
            return true;
        }
        return false;
    }

}