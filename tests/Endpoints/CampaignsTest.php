<?php

namespace tests\EncreInformatique\DoctorSenderApi\Endpoints;

use PHPUnit\Framework\TestCase;
use EncreInformatique\DoctorSenderApi\Endpoints\Campaigns;

class CampaignsTest extends TestCase
{
    const DS_METHOD_GET_LIST = 'dsCampaignGetAll';
    const DS_METHOD_GET_ONE = 'dsCampaignGet';

    /**
     * @test
     */
    public function getListWithoutOptions()
    {
        $campaignEndpoint = new Campaigns(
            $this->getClient(
                $this->getCorrectResponse(),
                self::DS_METHOD_GET_LIST,
                array(
                    'status = \''.Campaigns::STATUS_FINISHED.'\'',
                    Campaigns::DEFAULT_FIELDS,
                    1,
                    Campaigns::DEFAULT_LIMIT
                )
            )
        );
        $result = $campaignEndpoint->getList([]);

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     */
    public function getListWithOptions()
    {
        $startDate = new \DateTime("yesterday");
        $endDate = new \DateTime("now");
        $userList = 45;
        $customLimit = 12;

        $options = [
            'date' => [
                'start' => $startDate,
                'end' => $endDate
            ],
            'fields' => ['name', 'amount'],
            'list' => $userList,
            'limit' => $customLimit
        ];

        $campaignEndpoint = new Campaigns(
            $this->getClient(
                $this->getCorrectResponse(),
                self::DS_METHOD_GET_LIST,
                array(
                    'status = \''.Campaigns::STATUS_FINISHED.'\' and send_date between \''.$startDate->format("Y-m-d").'\' and \''.$endDate->format("Y-m-d").'\' and user_list = \''.$userList.'\'',
                    ['name', 'amount'],
                    1,
                    $customLimit
                )
            )
        );
        $result = $campaignEndpoint->getList($options);

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     */
    public function getOneWithoutOption()
    {
        $campaignEndpoint = new Campaigns(
            $this->getClient(
                $this->getSingleResponse(),
                self::DS_METHOD_GET_ONE,
                array(
                    123,
                    Campaigns::DEFAULT_FIELDS,
                    1
                )
            )
        );
        $result = $campaignEndpoint->getOne(['id' => '123']);

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     */
    public function getOneWithOptions()
    {
        $campaignEndpoint = new Campaigns(
            $this->getClient(
                $this->getSingleResponse(),
                self::DS_METHOD_GET_ONE,
                array(
                    123,
                    ['name', 'amount'],
                    1
                )
            )
        );
        $result = $campaignEndpoint->getOne(['id' => '123', 'fields' => ['name', 'amount']]);

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     */
    public function getOneWithoutId()
    {
        if (!method_exists($this, 'addMethods')) {
            $soapClient = $this->getMockBuilder(\SoapClient::class)
                ->disableOriginalConstructor()
                ->setMethods(['webservice'])
                ->getMock();
        } else {
            $soapClient = $this->getMockBuilder(\SoapClient::class)
            ->disableOriginalConstructor()
            ->addMethods(['webservice'])
            ->getMock();
        }
            
        $soapClient->expects($this->never())->method('webservice');

        $campaignEndpoint = new Campaigns($soapClient);
        $result = $campaignEndpoint->getOne([]);

        $this->assertTrue(is_array($result));
        $this->assertTrue($result['error']);
        $this->assertEquals(Campaigns::ERROR_NO_ID, $result['msg']);
    }

    /**
     * @return array
     */
    private function getSingleResponse()
    {
        return [
            'id' => 123
        ];
    }

    /**
     * @return array
     */
    private function getCorrectResponse()
    {
        return [
            'messages' => array(
                ['id' => 12],
                ['id' => 13],
                ['id' => 15],
                ['id' => 32],
            )
        ];
    }

    /**
     * @param array $response
     * @param string $dsMethod
     * @param array $arguments
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getClient($response = [], $dsMethod = '', $arguments = [])
    {
        if (!method_exists($this, 'addMethods')) {
            $soapClient = $this->getMockBuilder(\SoapClient::class)
                ->disableOriginalConstructor()
                ->setMethods(['webservice'])
                ->getMock();
        } else {
            $soapClient = $this->getMockBuilder(\SoapClient::class)
            ->disableOriginalConstructor()
            ->addMethods(['webservice'])
            ->getMock();
        }

        $soapClient->expects($this->atMost(1))
            ->method('webservice')
            ->with($dsMethod, $arguments)
            ->willReturn($response);

        return $soapClient;
    }
}
