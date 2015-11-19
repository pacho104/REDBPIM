<?php

namespace Thruway\Message;

/**
 * Class Publish message
 * Sent by a Publisher to a Broker to publish an event.
 * <code>[PUBLISH, Request|id, Options|dict, Topic|uri]</code>
 * <code>[PUBLISH, Request|id, Options|dict, Topic|uri, Arguments|list]</code>
 * <code>[PUBLISH, Request|id, Options|dict, Topic|uri, Arguments|list, ArgumentsKw|dict]</code>
 *
 * @package Thruway\Message
 */
class PublishMessage extends Message implements ActionMessageInterface
{

    /**
     * using arguments trait
     * @see \Thruway\Message\ArgumentsTrait
     */
    use ArgumentsTrait;

    /**
     *
     * @var mixed
     */
    private $options;

    /**
     *
     * @var string
     */
    private $topicName;

    /**
     *
     * @var int
     */
    private $requestId;

    /**
     * Constructor
     *
     * @param int $requestId
     * @param mixed $options
     * @param string $topicName
     * @param mixed $arguments
     * @param mixed $argumentsKw
     */
    public function __construct($requestId, $options, $topicName, $arguments = null, $argumentsKw = null)
    {
        parent::__construct();

        $this->setRequestId($requestId);
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
        $this->setOptions($options);
        $this->topicName = $topicName;
    }

    /**
     * Get message code
     *
     * @return int
     */
    public function getMsgCode()
    {
        return static::MSG_PUBLISH;
    }

    /**
     * This is used by get message parts to get the parts of the message beyond
     * the message code
     *
     * @return array
     */
    public function getAdditionalMsgFields()
    {
        if ($this->getOptions() === null) {
            $this->setOptions(new \stdClass());
        }

        $options = (object)$this->getOptions();

        $a = [$this->getRequestId(), $options, $this->getTopicName()];

        $a = array_merge($a, $this->getArgumentsForSerialization());

        return $a;
    }

    /**
     * Set options
     *
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = (array)$options;
    }

    /**
     * Get options
     *
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set topic name
     *
     * @param string $topicName
     */
    public function setTopicName($topicName)
    {
        $this->topicName = $topicName;
    }

    /**
     * Get topic name
     *
     * @return string
     */
    public function getTopicName()
    {
        return $this->topicName;
    }

    /**
     * Set request ID
     *
     * @param int $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * Get request ID
     *
     * @return int
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * This returns the Uri so that the authorization manager doesn't have to know
     * exactly the type of object to get the Uri
     *
     * @return mixed
     */
    public function getUri()
    {
        return $this->getTopicName();
    }

    /**
     * This returns the action name "publish", "subscribe", "register", "call"
     *
     * @return mixed
     */
    public function getActionName()
    {
        return "publish";
    }


}
