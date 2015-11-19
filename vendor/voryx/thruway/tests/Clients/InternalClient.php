<?php

/**
 * This is an example of how to use the InternalClientTransportProvider
 *
 * For more information go to:
 * http://voryx.net/creating-internal-client-thruway/
 */
class InternalClient extends Thruway\Peer\Client
{
    /**
     * @var \Thruway\Peer\Router
     */
    private $router;

    public function onSessionStart($session, $transport)
    {
        $this->getCallee()->register($this->session, 'com.example.testcall', array($this, 'callTheTestCall'));

        $this->getCallee()->register($this->session, 'com.example.publish', array($this, 'callPublish'));

        $this->getCallee()->register(
            $this->session,
            'com.example.ping',
            array($this, 'callPing'),
            ['discloseCaller' => true]
        );

        $this->getCallee()->register(
            $this->session,
            'com.example.failure_from_rejected_promise',
            array($this, 'callFailureFromRejectedPromise')
        );

        $this->getCallee()->register(
            $this->session,
            'com.example.failure_from_exception',
            array($this, 'callFailureFromException')
        );

        $this->getCallee()->register(
            $this->session,
            'com.example.echo_with_argskw',
            array($this, 'callEchoWithKw')
        );

        $this->getCallee()->register(
            $this->session,
            'com.example.echo_with_argskw_with_promise',
            array($this, 'callEchoWithKwWithPromise')
        );

        //callWithProgressOption
        $this->getCallee()->register(
            $this->session,
            'com.example.progress_option',
            array($this, 'callWithProgressOption')
        );

        //callReturnSomeProgress
        $this->getCallee()->register(
            $this->session,
            'com.example.return_some_progress',
            array($this, 'callReturnSomeProgress')
        );

    }

    public function start()
    {
    }

    public function testCallWithArguments($res) {

    }

    public function callTheTestCall($res)
    {
        return array($res[0]);
    }

    public function callPublish($args)
    {
        $deferred = new \React\Promise\Deferred();

        $this->getPublisher()->publish($this->session, "com.example.publish", [$args[0]], ["key1" => "test1", "key2" => "test2"], ["acknowledge" => true])
            ->then(
                function () use ($deferred) {
                    $deferred->resolve('ok');
                },
                function ($error) use ($deferred) {
                    $deferred->reject("failed: {$error}");
                }
            );

        return $deferred->promise();
    }

    public function callPing($args, $kwArgs, $details) {
        if ($this->router === null) throw new \Exception("Router must be set before calling ping.");

        if (isset($details['caller'])) {
            $sessionIdToPing = $details['caller'];

            $theSession = $this->getRouter()->getSessionBySessionId($sessionIdToPing);

            // ping returns a promise - we can just return it
            return $theSession->getTransport()->ping(2);
        }

        return array("no good");
    }

    public function callFailureFromRejectedPromise() {
        $deferred = new \React\Promise\Deferred();
        //$deferred->reject("Call has failed :(");
        $this->getLoop()->addTimer(0, function () use ($deferred) { $deferred->reject("Call has failed :("); });

        return $deferred->promise();
    }

    public function callFailureFromException() {
        throw new \Exception('Exception Happened');
    }

    public function callEchoWithKw($args, $argsKw) {
        return new \Thruway\Result($args, $argsKw);
    }

    public function callEchoWithKwWithPromise($args, $argsKw) {
        $deferred = new \React\Promise\Deferred();

        $this->getLoop()->addTimer(0, function () use ($deferred, $args, $argsKw) {
                $deferred->resolve(new \Thruway\Result($args, $argsKw));
            });

        return $deferred->promise();
    }

    public function callWithProgressOption($args, $argsKw, $details) {
        if (is_array($details) && isset($details['receive_progress']) && $details['receive_progress']) {
            return "SUCCESS";
        } else {
            throw new \Exception("receive_progress option not set");
        }
    }

    public function callReturnSomeProgress($args, $argsKw, $details) {
        if (is_array($details) && isset($details['receive_progress']) && $details['receive_progress']) {
            $deferred = new \React\Promise\Deferred();

            $this->getLoop()->addTimer(1, function () use ($deferred) {
                    $deferred->progress(1);
                });
            $this->getLoop()->addTimer(2, function () use ($deferred) {
                    $deferred->progress(2);
                });
            $this->getLoop()->addTimer(3, function () use ($deferred) {
                    $deferred->resolve("DONE");
                });

            return $deferred->promise();
        } else {
            throw new \Exception("receive_progress option not set");
        }
    }

    /**
     * @param \Thruway\Peer\Router $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return \Thruway\Peer\Router
     */
    public function getRouter()
    {
        return $this->router;
    }



}