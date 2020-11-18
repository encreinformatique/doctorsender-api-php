<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;
use EncreInformatique\DoctorSenderApi\Endpoints\Users;

class SegmentsTest extends TestCase
{
    /**
     * @test
     */
    public function failBecauseEmptyListNameEndpoint()
    {
        self::expectException(\Exception::class);
        self::expectExceptionMessage('no name of list was provided');

        $username = 'abc';
        $api_token = '123';

        $ws = new DoctorSenderClient($username, $api_token);
        $reponse = $ws->makeRequest('segments/list', []);
    }
}
