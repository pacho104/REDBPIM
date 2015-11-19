<?php

namespace Thruway\Role;

use Thruway\AbstractSession;
use Thruway\Logging\Logger;
use Thruway\Manager\ManagerDummy;
use Thruway\Manager\ManagerInterface;
use Thruway\Message\ErrorMessage;
use Thruway\Message\EventMessage;
use Thruway\Message\Message;
use Thruway\Message\PublishedMessage;
use Thruway\Message\PublishMessage;
use Thruway\Message\SubscribedMessage;
use Thruway\Message\SubscribeMessage;
use Thruway\Message\UnsubscribedMessage;
use Thruway\Message\UnsubscribeMessage;
use Thruway\Session;
use Thruway\Subscription;

/**
 * Class Broker
 *
 * @package Thruway\Role
 */
class Broker extends AbstractRole
{

    /**
     * @var \SplObjectStorage
     */
    private $subscriptions;

    /**
     * @var array
     */
    private $topics;

    /**
     * @var \Thruway\Manager\ManagerInterface
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param \Thruway\Manager\ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager = null)
    {

        $this->subscriptions = new \SplObjectStorage();
        $this->topics        = [];
        $manager             = $manager ? $manager : new ManagerDummy();

        $this->setManager($manager);
        Logger::debug($this, "Broker constructor");
    }

    /**
     * Handle received message
     *
     * @param \Thruway\AbstractSession $session
     * @param \Thruway\Message\Message $msg
     * @throws \Exception
     * @return mixed|void
     */
    public function onMessage(AbstractSession $session, Message $msg)
    {
        Logger::debug($this,
            "Broker onMessage for " . json_encode($session->getTransport()->getTransportDetails()) . ": " . json_encode($msg)
        );

        if ($msg instanceof PublishMessage):
            $this->processPublish($session, $msg);
        elseif ($msg instanceof SubscribeMessage):
            $this->processSubscribe($session, $msg);
        elseif ($msg instanceof UnsubscribeMessage):
            $this->processUnsubscribe($session, $msg);
        else:
            throw new \Exception("Unhandled message type sent to broker: " . get_class($msg));
        endif;
    }

    /**
     * Process publish message
     *
     * @param \Thruway\Session $session
     * @param \Thruway\Message\PublishMessage $msg
     */
    protected function processPublish(Session $session, PublishMessage $msg)
    {
        Logger::debug($this, "processing publish message");

        $includePublisher = false;

        $excludedSessions = [];

        $whiteList = null;

        $options = $msg->getOptions();
        if (is_array($options)) {
            // see if they wanted confirmation
            if (isset($options['acknowledge']) && $options['acknowledge'] == true) {
                $publicationId = Session::getUniqueId();
                $session->sendMessage(
                    new PublishedMessage($msg->getRequestId(), $publicationId)
                );
            }
            if (isset($options['exclude_me']) && !$options['exclude_me']) {
                $includePublisher = true;
            }
            if (isset($options['exclude']) && is_array($options['exclude'])) {
                // fixup exclude array - make sure it is legit
                foreach ($options['exclude'] as $excludedSession) {
                    if (is_numeric($excludedSession)) {
                        array_push($excludedSessions, $excludedSession);
                    }
                }
            }
            if (isset($options['eligible']) && is_array($options['eligible'])) {
                $whiteList = [];
                foreach ($options['eligible'] as $sessionId) {
                    if (is_numeric($sessionId)) {
                        array_push($whiteList, $sessionId);
                    }
                }
            }
        }

        /* @var $subscription \Thruway\Subscription */
        foreach ($this->subscriptions as $subscription) {
            if ($msg->getTopicName() == $subscription->getTopic() &&
                ($includePublisher || $subscription->getSession() != $session)
            ) {
                if (!in_array($subscription->getSession()->getSessionId(), $excludedSessions)) {
                    if ($whiteList === null || in_array($subscription->getSession()->getSessionId(), $whiteList)) {
                        $eventMsg = EventMessage::createFromPublishMessage($msg, $subscription->getId());
                        $this->disclosePublisherOption($session, $eventMsg, $subscription);
                        $subscription->getSession()->sendMessage($eventMsg);
                    }
                }
            }
        }
    }

    /**
     * @param Session $session
     * @param EventMessage $msg
     * @param Subscription $subscription
     */
    private function disclosePublisherOption(Session $session, EventMessage $msg, Subscription $subscription)
    {
        if ($subscription->isDisclosePublisher() === true) {
            $details = [
                "caller"     => $session->getSessionId(),
                "authid"     => $session->getAuthenticationDetails()->getAuthId(),
                "authrole"   => $session->getAuthenticationDetails()->getAuthRole(),
                "authroles"  => $session->getAuthenticationDetails()->getAuthRoles(),
                "authmethod" => $session->getAuthenticationDetails()->getAuthMethod(),
            ];
            $msg->setDetails(array_merge($msg->getDetails(), $details));
        }
    }

    /**
     * Process subscribe message
     *
     * @param \Thruway\Session $session
     * @param \Thruway\Message\SubscribeMessage $msg
     */
    protected function processSubscribe(Session $session, SubscribeMessage $msg)
    {

        if (!static::uriIsValid($msg->getTopicName())) {
            $errorMsg = ErrorMessage::createErrorMessageFromMessage($msg);
            $session->sendMessage($errorMsg->setErrorURI('wamp.error.invalid_uri'));

            return;
        }

        if (!isset($this->topics[$msg->getTopicName()])) {
            $this->topics[$msg->getTopicName()] = [];
        }

        array_push($this->topics[$msg->getTopicName()], $session);

        $subscription = Subscription::createSubscriptionFromSubscribeMessage($session, $msg);
        $this->subscriptions->attach($subscription);
        $subscribedMsg = new SubscribedMessage($msg->getRequestId(), $subscription->getId());
        $session->sendMessage($subscribedMsg);

    }

    /**
     * Process Unsubcribe message
     *
     * @param \Thruway\Session $session
     * @param \Thruway\Message\UnsubscribeMessage $msg
     */
    protected function processUnsubscribe(Session $session, UnsubscribeMessage $msg)
    {

        $subscription = $this->getSubscriptionById($msg->getSubscriptionId());

        if (!$subscription || !isset($this->topics[$subscription->getTopic()])) {
            $errorMsg = ErrorMessage::createErrorMessageFromMessage($msg);
            $session->sendMessage($errorMsg->setErrorURI('wamp.error.no_such_subscription'));

            return;
        }

        $topicName = $subscription->getTopic();
        //$subscribers = $this->topics[$topicName];

        /* @var $subscriber \Thruway\Session */
        foreach ($this->topics[$topicName] as $key => $subscriber) {
            if ($subscriber == $session) {
                unset($this->topics[$topicName][$key]);
            }
        }

        if ($subscription) {
            $this->subscriptions->detach($subscription);
        }

        $session->sendMessage(new UnsubscribedMessage($msg->getRequestId()));
    }

    /**
     * Get subscription by ID
     *
     * @param $subscriptionId
     * @return \Thruway\Subscription|boolean
     */
    public function getSubscriptionById($subscriptionId)
    {
        /* @var $subscription \Thruway\Subscription */
        foreach ($this->subscriptions as $subscription) {
            if ($subscription->getId() == $subscriptionId) {
                return $subscription;
            }
        }

        return false;
    }

    /**
     * Handle message
     * Returns true if this role handles this message.
     *
     * @param \Thruway\Message\Message $msg
     * @return boolean
     */
    public function handlesMessage(Message $msg)
    {
        $handledMsgCodes = [
            Message::MSG_SUBSCRIBE,
            Message::MSG_UNSUBSCRIBE,
            Message::MSG_PUBLISH
        ];

        if (in_array($msg->getMsgCode(), $handledMsgCodes)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Process a session leave
     *
     * @todo make this better
     * @param \Thruway\Session $session
     */
    public function leave(Session $session)
    {
        $this->subscriptions->rewind();
        while ($this->subscriptions->valid()) {
            /* @var $subscription \Thruway\Subscription */
            $subscription = $this->subscriptions->current();
            $this->subscriptions->next();
            if ($subscription->getSession() == $session) {
                Logger::debug($this, "Leaving and unsubscribing: {$subscription->getTopic()}");
                $this->subscriptions->detach($subscription);
            }
        }

        foreach ($this->topics as $topicName => $subscribers) {
            foreach ($subscribers as $key => $subscriber) {
                if ($session == $subscriber) {
                    unset($subscribers[$key]);
                    Logger::debug($this, "Removing session from topic list: {$topicName}");

                }
            }
        }
    }

    /**
     * Set manager
     *
     * @param \Thruway\Manager\ManagerInterface $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * get manager
     *
     * @return \Thruway\Manager\ManagerInterface
     */
    public function getManager()
    {
        return $this->manager;
    }


    /**
     * Get list subscriptions
     *
     * @return array
     */
    public function managerGetSubscriptions()
    {
        $theSubscriptions = [];

        /** @var $subscription Subscription */
        foreach ($this->subscriptions as $subscription) {
            $theSubscriptions[] = [
                "id"      => $subscription->getId(),
                "topic"   => $subscription->getTopic(),
                "session" => $subscription->getSession()->getSessionId()
            ];
        }

        return [$theSubscriptions];
    }

} 
