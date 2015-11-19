<?php


class MultipleRegistrationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Thruway\Connection
     */
    private $_conn;
    /**
     * @var \Thruway\Connection
     */
    private $_conn2;

    private $_error;
    private $_result;

    public function setUp()
    {
        $this->_conn = new \Thruway\Connection(
            [
                "realm"       => 'regtest',
                "url"         => 'ws://127.0.0.1:8090',
                "max_retries" => 0
            ]
        );

        $loop = $this->_conn->getClient()->getLoop();

        $this->_conn2 = new \Thruway\Connection(
            [
                "realm"       => 'regtest',
                "url"         => 'ws://127.0.0.1:8090',
                "max_retries" => 0
            ],
            $loop
        );
    }

    public function theCallback($args)
    {
        return [];
    }

    public function testProcAlreadyExists()
    {
        $this->_error  = null;
        $this->_result = null;

        $this->_conn->on('open', function (\Thruway\ClientSession $session) {
            $session->register('test_registration', [$this, "theCallback"])->then(
                function () use ($session) {
                    // try registering again to make sure we get an error
                    $session->register('test_registration', [$this, "theCallback"])->then(
                        function () use ($session) {
                            $this->_error = "Second registration should not have worked";
                            $session->close();
                        },
                        function ($err) use ($session) {
                            // should get an error
                            // unregister
                            $session->unregister('test_registration')->then(
                                function () use ($session) {
                                    $this->_result = "success";
                                    $session->close();
                                },
                                function () {
                                    $this->error = "Unregistration failed";
                                }
                            );
                        }
                    );
                },
                function ($err) {
                    $this->error = "Registration failed";
                    $this->_conn->close();
                }
            );
        });

        $this->_conn->open();

        $this->assertNull($this->_error, "Error occurred: " . $this->_error);
        $this->assertEquals("success", $this->_result);
    }

    public function thePartitionedRPC1($args)
    {
        $this->_result .= "[start 1(" . $args[0] . ")]";
        $deferred = new \React\Promise\Deferred();

        $loop = $this->_conn->getClient()->getLoop();

        $loop->addTimer(2, function () use ($deferred, $args) {
            $deferred->resolve("[RPC 1(" . $args[0] . ")]");
        });

        return $deferred->promise();
    }

    public function thePartitionedRPC2($args)
    {
        $this->_result .= "[start 2(" . $args[0] . ")]";
        $deferred = new \React\Promise\Deferred();

        $loop = $this->_conn->getClient()->getLoop();

        $loop->addTimer(1, function () use ($deferred, $args) {
            $deferred->resolve("[RPC 2(" . $args[0] . ")]");
        });

        return $deferred->promise();
    }

    public function testMultiRegistration()
    {
        $this->_error  = null;
        $this->_result = null;

        $this->_conn->on('open', function (\Thruway\ClientSession $session) {
            $session->register('partitioned_rpc', [$this, "thePartitionedRPC1"],
                ["thruway_multiregister" => true])->then(
                function ($ret) use ($session) {

                    // this should fail because we are registering an identical rpc from the same connection
                    $session->register('partitioned_rpc', [$this, "thePartitionedRPC1"])->then(
                        function () use ($session) {
                            $this->_error = "Second registration from same connection should have failed";
                            $session->close();
                        },
                        function () use ($session) {
                            $this->_conn2->on('open', function (\Thruway\ClientSession $s2) use ($session) {
                                // this should fail without thruway_multiregister
                                $s2->register('partitioned_rpc', [$this, "thePartitionedRPC2"])->then(
                                    function () use ($s2, $session) {
                                        $this->_error = "Second registration without multiregister option should have failed";
                                        $s2->close();
                                        $session->close();
                                    },
                                    function () use ($s2, $session) {
                                        // this should be the 2nd RPC
                                        $s2->register('partitioned_rpc', [$this, "thePartitionedRPC2"],
                                            ["thruway_multiregister" => true])->then(
                                            function () use ($s2, $session) {
                                                // good - we have 2 registrations - lets make some calls
                                                $this->_result = "";
                                                $session->subscribe('thruway.metaevent.procedure.congestion',
                                                    function ($args) {
                                                        if (isset($args[0]) && isset($args[0]['name'])) {
                                                            $procName = $args[0]['name'];
                                                        } else {
                                                            $procName = "";
                                                        }
                                                        $this->_result = $this->_result . "[congestion(" . $procName . ")]";
                                                    })->then(function () use ($s2, $session) {
                                                    $promises   = [];
                                                    $promises[] = $session->call('partitioned_rpc', [0])->then(
                                                        function ($res) use ($s2, $session) {
                                                            $this->_result = $this->_result . $res;
                                                        },
                                                        function ($err) use ($s2, $session) {
                                                            $this->_error = "Error calling RPC attempt 1";
                                                            $s2->close();
                                                            $session->close();
                                                        }
                                                    );
                                                    $promises[] = $session->call('partitioned_rpc', [1])->then(
                                                        function ($res) use ($s2, $session) {
                                                            $this->_result = $this->_result . $res;
                                                        },
                                                        function ($err) use ($s2, $session) {
                                                            $this->_error = "Error calling RPC(2)";
                                                            $s2->close();
                                                            $session->close();
                                                        }
                                                    );
                                                    $promises[] = $session->call('partitioned_rpc', [2])->then(
                                                        function ($res) use ($s2, $session) {
                                                            $this->_result = $this->_result . $res;
                                                        },
                                                        function ($err) use ($s2, $session) {
                                                            $this->_error = "Error calling RPC";
                                                            $s2->close();
                                                            $session->close();
                                                        }
                                                    );

                                                    $pAll = \React\Promise\all($promises);

                                                    $pAll->then(function () use ($s2, $session) {
                                                            $s2->close();
                                                            $session->close();
                                                        },
                                                        function ($err) {
                                                            $this->_error = "Could not subscribe to metaevent";
                                                        }
                                                    );
                                                });
                                            },
                                            function () use ($s2, $session) {
                                                $this->_error = "Second registration failed with multiregister";
                                                $s2->close();
                                                $session->close();
                                            }
                                        );
                                    }
                                );
                            });

                            $this->_conn2->open();

                        }
                    );

                },
                function ($err) use ($session) {
                    $this->_error = "First registration failed";
                    var_dump($err);
                    $session->close();
                }
            );
        });

        $this->_conn->open();

        $this->assertNull($this->_error, "Error occurred: " . $this->_error);
        $this->assertEquals("211", $this->_result);
    }
} 