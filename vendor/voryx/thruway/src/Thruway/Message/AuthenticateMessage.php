<?php

namespace Thruway\Message;

/**
 * Class AuthenticateMessage
 * In response to a CHALLENGE message, an Endpoint MUST send an AUTHENTICATION message.
 * <code>[AUTHENTICATE, Signature|string, Extra|dict]</code>
 *
 * @package Thruway\Message
 */
class AuthenticateMessage extends Message
{

    /**
     * @var mixed
     */
    private $signature;

    /**
     * @var array
     */
    private $extra;

    /**
     * @param string $signature
     * @param array $extra
     */
    public function __construct($signature, $extra = null)
    {
        $this->setSignature($signature);
        $this->setExtra($extra);
    }

    /**
     * Get message code
     * 
     * @return int
     */
    public function getMsgCode()
    {
        return static::MSG_AUTHENTICATE;
    }

    /**
     * This is used by get message parts to get the parts of the message beyond
     * the message code
     *
     * @return array
     */
    public function getAdditionalMsgFields()
    {
        return [$this->getSignature(), (object)$this->getExtra()];
    }

    /**
     * Get authentication signature
     * 
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Get authentication extra
     * 
     * @return array
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param array $extra
     */
    public function setExtra($extra)
    {
        if ($extra === null) {
            $extra = new \stdClass();
        }

        $this->extra = $extra;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }
}
