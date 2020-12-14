<?php

namespace App\Services;

use Illuminate\Support\Str;

class FileService
{
    public static function fileSize($file)
    {
        $dec = 2;
        $bytes = $file->getSize();

        $size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    public static function fileName($file)
    {
        $name = date('H-m-s').'_'.(string) Str::uuid();
        return $name .'.'. $file->getClientOriginalExtension();
    }

}
