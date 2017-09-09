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
        $isTestList = false;
        if (isset($options['isTestList'])) {
            $isTestList = true;
        }

        return $this->client->webservice(
            'dsUsersListGetAll',
            array($isTestList)
        );
    }

    /**
     * We get the list of Fields of a Users List.
     *
     * @param $options
     */
    public function getFields($options)
    {
        if (!isset($options['name'])) {
            return ['error' => true, 'msg' => 'no name of list was provided'];
        }
        $listName = $options['name'];

        $isTestList = false;
        if (isset($options['isTestList'])) {
            $isTestList = true;
        }

        $getType = false;
        if (isset($options['getType'])) {
            $getType = true;
        }

        return $this->client->webservice(
            'dsUsersListGetFields',
            array($listName, $isTestList, $getType)
        );
    }
}
