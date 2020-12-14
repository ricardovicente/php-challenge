<?php

namespace App\Services;

interface ImportServiceInterface
{
    public static function import($items, $fileId);

    public static function insert($item, $fileId);
}
