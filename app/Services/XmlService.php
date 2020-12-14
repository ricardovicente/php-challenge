<?php

namespace App\Services;

use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;

class XmlService
{
    public static function process($file)
    {
        $stream = new Stream\File($file, 1024);
        $parser = new Parser\StringWalker();

        $streamer = new XmlStringStreamer($parser, $stream);

        $arr = [];

        while ($node = $streamer->getNode()) {
            $simpleXmlNode = simplexml_load_string($node);

            $arr[] = $simpleXmlNode;
        }

        return self::object_to_array($arr);
    }

    private static function object_to_array($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = self::object_to_array($val);
            }
        }
        else $new = $obj;
        return $new;       
    }
}
