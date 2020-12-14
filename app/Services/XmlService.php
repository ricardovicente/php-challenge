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

        while ($node = $streamer->getNode()) {
            $simpleXmlNode = simplexml_load_string($node);
            
            echo (string)$simpleXmlNode->personid;
        }

        return $simpleXmlNode;
    }
}
