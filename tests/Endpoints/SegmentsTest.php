<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;
use EncreInformatique\DoctorSenderApi\Endpoints\Users;

class SegmentsTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \Exception
     * @expectedExceptionMessage no name of list was provided
     */
    public function failBecauseEmptyListNameEndpoint()
    {
        $username = 'abc';
        $api_token = '123';

        $ws = new DoctorSenderClient($username, $api_token);
        $reponse = $ws->makeRequest('segments/list', []);
    }
}
