<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/24/17
 * Time: 3:04 PM
 */

namespace App\Http\Helpers;

use TesseractOCR;

class Ocr
{

    /**
     * @param $image
     * @return null|string
     */
    public static function run($image){

        if(file_exists($image))
        {
            $x = pathinfo($image);
            $x['dirname'];
            $x['basename'];
            $x['extension'];
            $x['filename'];

            try{
                $ocr_class = new \TesseractOCR($image);
                $text = $ocr_class->lang('eng')->run();

            }catch (\Exception $e){
                $text = $e->getMessage();
            }

            return $text;

        }else{
            return null;
        }

    }
}