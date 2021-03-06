<?php
namespace Oro\Component\MessageQueue\Tests\Unit\Client;

use Oro\Component\MessageQueue\Transport\ConnectionInterface;
use Oro\Component\MessageQueue\Transport\Null\NullConnection;
use Oro\Component\MessageQueue\Transport\Null\NullSession;
use Oro\Component\MessageQueue\Client\Config;
use Oro\Component\MessageQueue\Client\NullDriver;
use Oro\Component\MessageQueue\Client\DriverFactory;

class DriverFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCreateNullSessionInstance()
    {
        $config = new Config('', '', '', '');

        $connection = $this->createNullConnectionMock();
        $connection
            ->expects($this->once())
            ->method('createSession')
            ->will($this->returnValue($this->createNullSessionMock()))
        ;

        $driver = DriverFactory::create($connection, $config);

        $this->assertInstanceOf(NullDriver::class, $driver);
    }

    public function testShouldThrowExceptionIfUnexpectedConnectionInstance()
    {
        $this->setExpectedException(\LogicException::class, 'Unexpected connection instance: "Mock_Connection');

        DriverFactory::create($this->getMock(ConnectionInterface::class), new Config('', '', '', ''));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|NullSession
     */
    protected function createNullSessionMock()
    {
        return $this->getMock(NullSession::class, [], [], '', false);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|NullConnection
     */
    protected function createNullConnectionMock()
    {
        return $this->getMock(NullConnection::class, [], [], '', false);
    }
}
