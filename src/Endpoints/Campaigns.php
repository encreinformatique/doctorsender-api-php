<?php

namespace EncreInformatique\DoctorSenderApi\Endpoints;

class Campaigns extends Endpoint
{
    private $fields = array("name", "amount", "subject", "html", "text", "list_unsubscribe", "send_date", "status", "user_list", "country", "utm_source", "utm_medium", "utm_term", "utm_content", "utm_campaign");

    /*
     * SoapClient $client
     */
    private $client;

    /*
     * We can retrieve the Campaigns with or without Statistics.
     *
     * Add statistic extra info 
     * [0: none, 1: statistics, 2: statistics without unique values (faster)] 
     */
    private $withStatistics = 1;

    /*
     * Maximum number of returned campaigns.
     * 0 means all campaigns with the indicated conditions 
     */
    private $limit = 10;

    public function __construct($client)
    {
        $this->client = $client;
        $this->withStatistics = 1;
    }

    /**
     * We get the List of Campaigns.
     *
     * @param $options
     */
    public function getList($options)
    {
        $sqlWhere = 'status = \'finished\'';

        /*
         * We define the fields.
         */
        if (isset($options['date'])) {
            if (!empty($options['date']['start'])) {
                if (empty($options['date']['end'])) {
                    $endDate = $options['date']['end'];
                } else {
                    $endDate = new \DateTime("tomorrow");
                }
                $sqlWhereDate = 'send_date between \''.$options['date']['start']->format("Y-m-d").'\' and \''.$endDate->format("Y-m-d").'\'';
            } elseif (!empty($options['date']['end'])) {
                $sqlWhereDate = 'send_date <= \''.$options['date']['end']->format("Y-m-d").'\'';
            }

            $sqlWhere.= ' and '.$sqlWhereDate;
        }

        /*
         * We define the fields.
         */
        if (isset($options['fields'])) {
            $fields = $options['fields'];
        } else {
            $fields = $this->fields;
        }

        return $this->client->webservice(
                'dsCampaignGetAll',
                array($sqlWhere, $fields, $this->withStatistics, $this->limit)
            );
    }

    /**
     * We get the List of Campaigns.
     *
     * @param $options
     */
    public function getOne($options)
    {
        if (!isset($options['id'])) {
            return ['error' => true, 'msg' => 'no campaign id was provided'];
        }
        $idCampaign = $options['id'];

        /*
         * We define the fields.
         */
        if (isset($options['fields'])) {
            $fields = $options['fields'];
        } else {
            $fields = $this->fields;
        }

        return $this->client->webservice(
                'dsCampaignGet',
                array($idCampaign, $fields, $this->withStatistics)
            );
    }
}
