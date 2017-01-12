<?php
/**
 * Created by PhpStorm.
 * User: anwar
 * Date: 1/10/17
 * Time: 6:53 PM
 */

namespace App\Http\Helpers;


class DirectoryCheckPermission
{
    /**
     * @param $directory
     * @return bool
     */
    public static function check_permission($directory)
    {
        if(is_writable($directory)){
            return true;
        }
        return false;
    }

    /**
     * @param $dirctory
     * @param $permission
     * @return bool
     */
    public static function set_permission($directory, $permission)
    {
        if (chmod($directory, $permission)) {
            return true;
        }
        return false;
    }

}