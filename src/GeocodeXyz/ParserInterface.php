<?php

namespace GeocodeXyz;

interface ParserInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $raw
     * @return \stdClass
     */
    public function parse($raw);
}