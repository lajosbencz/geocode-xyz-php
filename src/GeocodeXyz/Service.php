<?php

namespace GeocodeXyz;

use GeocodeXyz\Parser\Json;

class Service
{
    const API_URL = 'https://geocode.xyz/';

    /** @var string */
    protected $_authCode;

    /** @var Request */
    protected $_request;

    /** @var ParserInterface */
    protected $_parser;

    protected function _getData(array $data)
    {
        return array_merge($data, [
            'auth' => $this->_authCode,
        ]);
    }

    public function __construct($authCode, $parserClass = Json::class)
    {
        if(strlen($authCode) < 1) {
            throw new \InvalidArgumentException('missing $authCode parameter');
        }
        $this->_authCode = $authCode;
        $this->_request = new Request;
        $this->setParser(new $parserClass());
    }

    public function setParser(ParserInterface $parser)
    {
        $this->_parser = $parser;
        return $this;
    }

    public function geocodeForward($locate)
    {
        $data = $this->_getData([
            'locate' => $locate,
            'geoit' => $this->_parser->getCode(),
        ]);
        $raw = $this->_request->post($data);
        $parsed = $this->_parser->parse($raw);
        return $parsed;
    }

    public function geocodeBackward($latitude, $longitude)
    {
        // @TODO
    }

}