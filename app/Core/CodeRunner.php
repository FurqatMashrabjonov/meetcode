<?php

namespace App\Core;

class CodeRunner
{
    public static function run($code, $lang){
        //make it for python3
        $file_path = public_path('python');
        $file_name = 'code.py';
        $file = fopen($file_path . '/' . $file_name, 'w');
        fwrite($file, $code);
        fclose($file);
        $output = shell_exec('python3 ' . $file_path . '/' . $file_name);
        return $output;


//        $file_path = public_path('nodejs');
//        $file_name = 'code.py';
//        $file = fopen($file_path . '/' . $file_name, 'w');
//        fwrite($file, $code);
//        fclose($file);
//        $output = shell_exec('node ' . $file_path . '/' . $file_name);
//        return $output;
    }
}
