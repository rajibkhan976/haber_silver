<?php
/**
 * Created by PhpStorm.
 * User: anwar
 * Date: 1/16/17
 * Time: 6:00 PM
 */

namespace App\Http\Helpers;

use Modules\Admin\Models\Settings;


class CodeGenerateHelper
{


    public static function generate_code($type)
    {
        $settings = Settings::where('status', '=', 'active')->where('type', $type)->first();
        if ($settings) {
            $number = $settings['last_number'] + $settings['increment'];
            $settings_code = $settings['code'];
            $settings_year = Date('Y');
            $settings_id = $settings['id'];
            $generate_voucher_number = $settings_code . '-' . $settings_year . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
            $array = array('generated_code' => $generate_voucher_number, 'setting_id' => $settings_id, 'number' => $number);
            return $array;
        } else {
            return false;
        }
    }

    public static function update_row($row_id, $value)
    {
        $settings = Settings::findOrFail($row_id);
        if ($settings) {
            $settings->last_number = $value;
            $settings->save();
            return true;
        } else {
            return false;
        }
    }
}