<?php

namespace GeocodeXyz;

abstract class Parser implements ParserInterface
{
    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getCode()
    {
        static $code;
        if(!$code) {
            $reflect = new \ReflectionClass($this);
            $code = strtoupper($reflect->getShortName());
        }
        return $code;
    }
}