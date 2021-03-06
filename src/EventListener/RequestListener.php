<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->attributes->get('_locale');

        if (null !== $locale) {
            $request->setLocale($locale);
        }
    }
}