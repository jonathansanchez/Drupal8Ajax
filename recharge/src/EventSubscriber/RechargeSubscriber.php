<?php

namespace Drupal\recharge\EventSubscriber;

use Drupal\recharge\Event\RechargeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RechargeSubscriber implements EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            RechargeEvent::NAME => ['rechargeEvent', 0]
        ];
    }

    /**
     * Log for number recharged
     *
     * @param RechargeEvent $event
     */
    public function rechargeEvent(RechargeEvent $event)
    {
        /**
         * Some tasks
         * Send a email
         * Notify an user
         * ...
         */
        $number = $event->getNumber();
        file_put_contents(
            __DIR__ . '/recharge.log',
            $number->getMsisdn()->value() . "\n",
            FILE_APPEND
        );
    }
}