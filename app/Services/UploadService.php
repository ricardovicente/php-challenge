<?php

namespace App\Services;

use Exception;

class UploadService
{
    public static function upload($file, $fileName)
    {
        $path = $file->storeAs(
            self::getDir(), $fileName
        );

        if (!$path) {
            throw new Exception("Erro ao salvar arquivo");
        }

        return $path;
    }

    public static function getDir()
    {
        return config('app.storage.xmls').'/'.date('Y').'/'.date('m').'/'.date('d');
    }
}
