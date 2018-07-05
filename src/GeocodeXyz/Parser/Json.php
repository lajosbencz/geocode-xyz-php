<?php

namespace GeocodeXyz\Parser;

use GeocodeXyz\Parser;
use GeocodeXyz\ParserInterface;

class Json extends Parser implements ParserInterface
{
    public function parse($raw)
    {
        return json_decode($raw);
    }
}