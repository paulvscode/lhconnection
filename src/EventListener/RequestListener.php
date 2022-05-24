<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function __construct() {
        dd('toto');
    }

    public function onKernelRequest(RequestEvent $event)
    {
        dd('titi');
    }
}