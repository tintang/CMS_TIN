<?php

namespace App\Core\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SetLocalizationEventListener implements EventSubscriberInterface
{


    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => [
                ['setLocale', 1000]
            ]
        ];
    }

    public function setLocale(RequestEvent $event)
    {
        $request = $event->getRequest();
        if ($locale = $request->headers->get('Accept-Language')) {
            $request->setLocale($locale);
        }
    }
}