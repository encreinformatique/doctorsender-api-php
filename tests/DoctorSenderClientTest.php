<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;

class DoctorSenderClientTest extends TestCase
{
    /**
     * @test
     */
    public function failInitialisation()
    {
        self::expectException(\RuntimeException::class);
        self::expectExceptionMessage('The User or the Token cannot be nulled.');

        $username = null;
        $api_token = null;

        $ws = new DoctorSenderClient($username, $api_token);
    }

    /**
     * @test
     */
    public function failEndpoint()
    {
        self::expectException(\Exception::class);

        $username = null;
        $api_token = null;

        $ws = new DoctorSenderClient($username, $api_token);

        $campaigns = $ws->makeRequest('campaignns/list', []);
    }
}
