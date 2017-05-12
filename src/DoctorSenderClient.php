<?php

namespace EncreInformatique\DoctorSenderApi;

use SoapClient;
use SoapHeader;

class DoctorSenderClient
{
    const WEBSERVICE_URL = 'http://soapwebservice.doctorsender.com/server.wsdl';

    /*
     * SoapClient $client
     */
    private $client;

    /**
     * The Constructor of DoctorSenderClient
     *
     * @param user: the Username for the authorization.
     * @param token: the Token for the authorization.
     */
    public function __construct($user, $token)
    {
        if (!class_exists("SoapClient")) {
            throw new \RuntimeException("The SoapClient class needs to be available.");
        }
        if ($user == null || $token == null) {
            throw new \RuntimeException("The User or the Token cannot be nulled.");
        }

        /*
         * We initialize the Client to be ready to use on each Request.
         */
        $this->client = new SoapClient(self::WEBSERVICE_URL, array("trace"=>true, 'cache_wsdl' => WSDL_CACHE_NONE));
        $this->client->__setSoapHeaders(new SoapHeader("ns1", "app_auth", array("user" => $user, "pass" => $token)));
    }

    /**
     * We make the Request to the API.
     *
     * @param endpoint
     * @throws Exception
     * @return string
     */
    public function makeRequest($endpoint, $options)
    {
        /*
         * We find the right Class and Function.
         */
        $points = explode('/', $endpoint);

        if (count($points) !== 2) {
            throw new \Exception("The endpoint does not exist.");
        }

        $endPointName = '\EncreInformatique\DoctorSenderApi\Endpoints\\'.$points[0];

        if (!class_exists($endPointName)) {
            throw new \Exception("The endpoint does not exist.");
        }

        $endPoint = new $endPointName($this->client);
        /*
         * If we have an ID as second part, call getOne.
         */
        if (is_numeric($points[1])) {
            $options['id'] = $points[1];
            $result = $endPoint->__call('getOne', $options);
        } else {
            $result = $endPoint->__call('get'.ucfirst($points[1]), $options);
        }

        if (!is_array($result)) {
            throw new \Exception("Error occurred in webservice call");
        }
        if ($result["error"] === true) {
            throw new \Exception($result["msg"]);
        } else {
            return $result["msg"];
        }
    }
}
