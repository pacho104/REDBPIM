<?php

namespace Thruway\Transport;

use React\EventLoop\LoopInterface;
use React\SocketClient\Connector;
use React\Stream\Stream;
use Thruway\Manager\ManagerInterface;
use Thruway\Peer\AbstractPeer;
use Thruway\Serializer\JsonSerializer;

/**
 * Class RawSocketClientTransportProvider
 * 
 * Implements transport provider on raw socket for client
 * 
 * @package Thruway\Transport
 */
class RawSocketClientTransportProvider implements TransportProviderInterface
{

    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $port;

    /**
     * @var \Thruway\Manager\ManagerInterface
     */
    private $manager;

    /**
     * @var \Thruway\Peer\AbstractPeer
     */
    private $peer;

    /**
     * @var \React\EventLoop\LoopInterface
     */
    private $loop;

    /**
     * @var \Thruway\Transport\RawSocketTransport
     */
    private $transport;

    /**
     * @var boolean
     */
    private $trusted;

    /**
     * Constructor
     * 
     * @param string $address
     * @param int $port
     */
    function __construct($address = "127.0.0.1", $port = 8181)
    {
        $this->address = $address;
        $this->port    = $port;

        $this->transport = null;
    }

    /**
     * Start transport provider
     * 
     * @param \Thruway\Peer\AbstractPeer $peer
     * @param \React\EventLoop\LoopInterface $loop
     */
    public function startTransportProvider(AbstractPeer $peer, LoopInterface $loop)
    {
        $this->peer = $peer;
        $this->loop = $loop;

        $dnsResolverFactory = new \React\Dns\Resolver\Factory();
        $dns                = $dnsResolverFactory->createCached('8.8.8.8', $loop);

        $connector = new Connector($loop, $dns);

        $connector->create($this->address, $this->port)->then(function (Stream $stream) {
            $stream->on('data', [$this, "handleData"]);
            $stream->on('close', [$this, "handleClose"]);
            $this->handleConnection($stream);
        });
    }

    /**
     * Handle process on open new connection
     * 
     * @param \React\Stream\Stream $conn
     */
    public function handleConnection(Stream $conn)
    {
        //$this->getManager()->debug("Raw socket opened");

        $this->transport = new RawSocketTransport($conn, $this->loop, $this->peer);

        $this->transport->setSerializer(new JsonSerializer());

        $this->transport->setTrusted($this->trusted);

        $this->peer->onOpen($this->transport);
    }

    /**
     * Handle process reveiced data
     * 
     * @param mixed $data
     * @param \React\Stream\Stream $conn
     */
    public function handleData($data, Stream $conn)
    {
        $this->transport->handleData($data);
    }

    /**
     * Handle process on close connection
     * 
     * @param \React\Stream\Stream $conn
     */
    public function handleClose(Stream $conn)
    {
        //$this->getManager()->debug("Raw socket closed " . $conn->getRemoteAddress());

        $this->peer->onClose($this->transport);
    }

    /**
     * Get manager
     * 
     * @return \Thruway\Manager\ManagerInterface
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set manager
     * 
     * @param \Thruway\Manager\ManagerInterface $managerInterface
     */
    public function setManager(ManagerInterface $managerInterface)
    {
        $this->manager = $managerInterface;
    }

    /**
     * @param boolean $trusted
     */
    public function setTrusted($trusted)
    {
        $this->trusted = $trusted;
    }
}
