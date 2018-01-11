<?php

namespace EncreInformatique\DoctorSenderApi\Endpoints;

class Campaigns extends Endpoint
{
    const STATUS_FINISHED = 'finished';
    const DEFAULT_FIELDS = array("name", "amount", "subject", "html", "text", "list_unsubscribe", "send_date", "status", "user_list", "country", "utm_source", "utm_medium", "utm_term", "utm_content", "utm_campaign");

    /*
     * Maximum number of returned campaigns.
     * 0 means all campaigns with the indicated conditions
     */
    const DEFAULT_LIMIT = 10;

    /*
     * Error messages
     */
    const ERROR_NO_ID = 'no campaign id was provided';

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

    public function __construct($client)
    {
        $this->client = $client;
        $this->withStatistics = 1;
    }

    /**
     * We get the List of Campaigns.
     *
     * @param $options
     * @return array
     */
    public function getList($options)
    {
        $sqlWhere = 'status = \''.self::STATUS_FINISHED.'\'';

        /*
         * We define the Date filters.
         */
        if (isset($options['date'])) {
            if (!empty($options['date']['start'])) {
                $endDate = new \DateTime("tomorrow");
                if (!empty($options['date']['end'])) {
                    $endDate = $options['date']['end'];
                }
                $sqlWhereDate = 'send_date between \''.$options['date']['start']->format("Y-m-d").'\' and \''.$endDate->format("Y-m-d").'\'';
            } elseif (!empty($options['date']['end'])) {
                $sqlWhereDate = 'send_date <= \''.$options['date']['end']->format("Y-m-d").'\'';
            }

            if (isset($sqlWhereDate)) {
                $sqlWhere.= ' and '.$sqlWhereDate;
            }
        }

        /*
         * We define the List filters.
         */
        if (isset($options['list']) && preg_match("`([A-z0-9 _-]+)`", $options['list'])) {
            // We clean the string
            $options['list'] = trim($options['list']);

            $sqlWhereList = 'user_list = \''.$options['list'].'\'';

            $sqlWhere.= ' and '.$sqlWhereList;
        }

        /*
         * We define the fields.
         */
        $fields = self::DEFAULT_FIELDS;
        if (isset($options['fields'])) {
            $fields = $options['fields'];
        }

        /*
         * Override the limit.
         */
        $limit = self::DEFAULT_LIMIT;
        if (isset($options['limit'])) {
            $limit = $options['limit'];
        }

        return $this->client->webservice(
            'dsCampaignGetAll',
            array($sqlWhere, $fields, $this->withStatistics, $limit)
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
            return ['error' => true, 'msg' => self::ERROR_NO_ID];
        }
        $idCampaign = $options['id'];

        /*
         * We define the fields.
         */
        $fields = self::DEFAULT_FIELDS;
        if (isset($options['fields'])) {
            $fields = $options['fields'];
        }

        return $this->client->webservice(
            'dsCampaignGet',
            array($idCampaign, $fields, $this->withStatistics)
        );
    }
}
