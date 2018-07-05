<?php

class ServiceTest extends BaseTest
{
    public function testService()
    {
        $result = self::$service->geocodeForward('budapest, taban');
        $this->assertNotNull($result);
    }
}