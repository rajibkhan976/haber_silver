<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/22/17
 * Time: 7:09 PM
 */

namespace App\Http\Helpers;


class GetFilesFromDirectory
{
    public static function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach($files as $key => $value)
        {
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            }
            else if($value != "." && $value != "..")
            {
                GetFilesFromDirectory::getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }


}