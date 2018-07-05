<?php

class ParserTest extends BaseTest
{
    public function provideData()
    {
        return [
            ['budapest, krisztina körút 99.'],
        ];
    }

    public function _testResult($r)
    {
        $this->assertObjectHasAttribute('standard', $r);
        $this->assertObjectHasAttribute('stnumber', $r->standard);
        $this->assertObjectHasAttribute('addresst', $r->standard);
        $this->assertObjectHasAttribute('postal', $r->standard);
        $this->assertObjectHasAttribute('region', $r->standard);
        $this->assertObjectHasAttribute('prov', $r->standard);
        $this->assertObjectHasAttribute('city', $r->standard);
        $this->assertObjectHasAttribute('countryname', $r->standard);
        $this->assertObjectHasAttribute('confidence', $r->standard);
        $this->assertObjectHasAttribute('longt', $r);
        $this->assertObjectHasAttribute('latt', $r);
        $this->assertObjectHasAttribute('alt', $r);
        $this->assertObjectHasAttribute('elevation', $r);
        $this->assertObjectHasAttribute('remaining_credits', $r);
    }

    /**
     * @dataProvider provideData
     * @param $address
     */
    public function testParsers($address)
    {
        self::$service->setParser(new \GeocodeXyz\Parser\Json);
        $result = self::$service->geocodeForward($address);
        $this->assertNotNull($result);
        $this->_testResult($result);

        self::$service->setParser(new \GeocodeXyz\Parser\Xml);
        $result = self::$service->geocodeForward($address);
        $this->assertNotNull($result);
        $this->_testResult($result);


        self::$service->setParser(new \GeocodeXyz\Parser\Csv);
        $result = self::$service->geocodeForward($address);
        $this->assertNotNull($result);
        $this->_testResult($result);
    }
}