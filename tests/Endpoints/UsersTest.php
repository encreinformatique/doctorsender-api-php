<?php

namespace tests\EncreInformatique\DoctorSenderApi;

use EncreInformatique\DoctorSenderApi\Endpoints\Users;
use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\DoctorSenderClient;

class UsersTest extends TestCase
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
        $reponse = $ws->makeRequest('users/create', []);
    }

    /**
     * @test
     */
    public function failBecauseEmptyUserEndpoint()
    {
        self::expectException(\Exception::class);
	self::expectExceptionMessage('no correct user was provided');

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

//        $soapClientMock = $this->getMockFromWsdl(DoctorSenderClient::WEBSERVICE_URL);
        $soapClientMock = $this->getMockBuilder(\SoapClient::class)
            ->disableOriginalConstructor()
            ->addMethods(['webservice'])
            ->getMock();
        $soapClientMock
            ->expects(self::once())
            ->method('webservice')
            ->with(
                'dsUsersListAdd',
                [$options['listName'], $options['user'], false]
            )
            ->willReturn(true);

        $endpoint = new Users($soapClientMock);
        $response = $endpoint->create($options);

        self::assertTrue($response);
    }
}
