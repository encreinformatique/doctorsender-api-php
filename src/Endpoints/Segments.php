<?php

namespace EncreInformatique\DoctorSenderApi\Endpoints;

class Segments extends Endpoint
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
        if (!isset($options['name'])) {
            return ['error' => true, 'msg' => 'no name of list was provided'];
        }
        $listName = str_replace("list_", "", $options['name']);

        return $this->client->webservice(
            'dsSegmentsGetByListName',
            array($listName)
        );
    }
}
