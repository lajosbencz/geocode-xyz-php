<?php

namespace GeocodeXyz;

class Request
{
    /** @var resource */
    protected $_curl;

    /**
     * @param string $url (optional)
     * @throws Exception
     */
    public function __construct($url = Service::API_URL)
    {
        $this->_curl = curl_init($url);
        if(!$this->_curl) {
            throw new Exception('Failed to initialize CURL for Request');
        }
        if(!curl_setopt_array($this->_curl, [
            CURLOPT_POST => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_RETURNTRANSFER => 1,
        ])) {
            throw new Exception('Failed to set options on CURL resource');
        }
    }

    public function __destruct()
    {
        if(is_resource($this->_curl)) {
            @fclose($this->_curl);
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws RequestException
     */
    public function post(array $data)
    {
        curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($this->_curl);
        $error = curl_error($this->_curl);
        if($error) {
            curl_close($this->_curl);
            throw new RequestException($error, curl_errno($this->_curl));
        }
        return $result;
    }
}