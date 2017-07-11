<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;
use EncreInformatique\DoctorSenderApi\Endpoints\Users;

class UsersTest extends TestCase
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
        $reponse = $ws->makeRequest('users/create', []);
    }

    /**
     * @test
     *
     * @expectedException \Exception
     * @expectedExceptionMessage no correct user was provided
     */
    public function failBecauseEmptyUserEndpoint()
    {
        $username = 'abc';
        $api_token = '123';

        $ws = new DoctorSenderClient($username, $api_token);
        $reponse = $ws->makeRequest('users/create', ['listName' => 'list1']);
    }
}
