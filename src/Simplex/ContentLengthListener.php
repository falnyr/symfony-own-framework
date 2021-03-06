<?php

namespace Simplex;

class ContentLengthListener implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }

    public static function getSubscribedEvents()
    {
        return ['response' => ['onResponse', -255]];
    }
}
