<?php

// src/EventListener/S3UploaderListner.php
namespace App\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\CodesCsvFile;

/**
 * S3UploaderListner
 */
class S3UploaderListner
{
	
	public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
  var_dump($entity);die;
        if ($entity instanceof CodesCsvFile) 
        {
            //
            var_dump($entity);
        	throw new \Exception('Upload action');
        }
    }
}