<?php

// src/EventListener/BneeCodeListner.php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class BneeCodeListner
 * 
 * @author Red
 */
class BneeCodeListner
{

    private $logger;
    private $request;

    /**
     * @param LoggerInterface $logger
     * @param RequestStack $request
     */
    public function __construct(LoggerInterface $logger, RequestStack $request)
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    /**
     * onAuthenticationFailure
     */
    public function onAuthenticationFailure()
    {
        $ipAddress = $this->request->getCurrentRequest()->getClientIp();
        $this->logger->error('[BNEE] Redeem code failed for IP: ' . $ipAddress);
    }
}