<?php

namespace GeocodeXyz\Parser;

use GeocodeXyz\Parser;
use GeocodeXyz\ParserInterface;

class Xml extends Parser implements ParserInterface
{
    public function parse($raw)
    {
        return simplexml_load_string($raw);
    }

}