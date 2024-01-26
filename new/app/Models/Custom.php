<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Custom extends Model
{

    public static function setCommon(array $data)
    {
        $env = app()->environmentFilePath();
        $string = file_get_contents($env);
        if (count($data) > 0) {
            foreach ($data as $key => $val) {
                $keyPos = strpos($string, "{$key}=");
                $endLinePos = strpos($string, "\n", $keyPos);
                $oldPos = substr($string, $keyPos, $endLinePos - $keyPos);
                if (!$keyPos || !$endLinePos || !$oldPos) {
                    $string .= "{$key}='{$val}'\n";
                } else {
                    $string = str_replace($oldPos, "{$key}='{$val}'", $string);
                }
            }
        }
        $string = substr($string, 0, -1);
        $string .= "\n";
        if (!file_put_contents($env, $string)) {
            return false;
        }

        return true;
    }

    public static function languages()
    {
        $dir = base_path() . '/resources/lang/';
        $glob = glob($dir . "*", GLOB_ONLYDIR);

        $arrLang = array_map(
            function ($value) use ($dir) {
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir) {
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }



    public static function permissionModules()
    {
        return $modules = [
            'user',
            'role',
            'property',
            'unit',
            'tenant',
            'invoice',
            'invoice type',
            'invoice payment',
            'expense',
            'maintainer',
            'maintenance request',
            'logged history',
            'contact',
            'support',
            'note',
            'account settings',
            'password settings',
            'general settings',
            'company settings',
           ];
    }

    public function langKeyword(){
        $langKeyword=[
            __('Own Property'),
            __('Lease Property'),
            __('Open'),
            __('Paid'),
            __('Partial Paid'),
            __('Pending'),
            __('In Progress'),
            __('Completed'),
        ];
    }
}
