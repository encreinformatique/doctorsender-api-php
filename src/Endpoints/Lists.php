<?php

namespace EncreInformatique\DoctorSenderApi\Endpoints;

class Lists extends Endpoint
{
    /*
     * SoapClient $client
     */
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * We get the List of Users.
     *
     * @param $options
     */
    public function getList($options)
    {
        if (isset($options['isTestList'])) {
            $isTestList = true;
        } else {
            $isTestList = false;
        }

        return $this->client->webservice(
                'dsUsersListGetAll',
                array($isTestList)
            );
    }
}
