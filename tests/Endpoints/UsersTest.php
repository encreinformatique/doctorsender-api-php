<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use EncreInformatique\DoctorSenderApi\Endpoints\Users;
use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;

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

    /**
     * @test
     */
    public function testListShouldNotBeTrue()
    {
        $options = [
            'listName' => 'list_abc',
            'user' => [
                'email' => 'myemail@example.com'
            ],
            'isTestList' => false
        ];

        $soapClientMock = $this->getMockFromWsdl(DoctorSenderClient::WEBSERVICE_URL);
        $soapClientMock
            ->method('webservice')
            ->with(
                'dsUsersListAdd',
                [$options['listName'], $options['user'], false]
            )
            ->willReturn(true);


        $endpoint = new Users($soapClientMock);
        $response = $endpoint->create($options);

        $this->assertTrue($response);
    }
}
