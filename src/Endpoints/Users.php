<?php

namespace EncreInformatique\DoctorSenderApi\Endpoints;

class Users extends Endpoint
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
     * We get the list of Fields of a Users List.
     *
     * @param $options
     */
    public function create($options)
    {
        if (!isset($options['listName'])) {
            return ['error' => true, 'msg' => 'no name of list was provided'];
        }
        /*
         * User information is mandatory.
         */
        if (!isset($options['user']) || !isset($options['user']['email'])) {
            return ['error' => true, 'msg' => 'no correct user was provided'];
        }
        $listName = $options['listName'];
        $user = $options['user'];

        $isTestList = false;
        if (isset($options['isTestList'])) {
            $isTestList = true;
        }

        return $this->client->webservice(
            'dsUsersListAdd',
            array($listName, $user, $isTestList)
        );
    }
}
