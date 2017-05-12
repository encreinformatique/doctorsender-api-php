<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;

class DoctorSenderClientTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The User or the Token cannot be nulled.
     */
    public function failInitialisation()
    {
        $username = null;
        $api_token = null;

        $ws = new DoctorSenderClient($username, $api_token);
    }

    /**
     * @test
     *
     * @expectedException \Exception
     */
    public function failEndpoint()
    {
        $username = null;
        $api_token = null;

        $ws = new DoctorSenderClient($username, $api_token);

        $campaigns = $ws->makeRequest('campaignns/list', []);
    }
}
