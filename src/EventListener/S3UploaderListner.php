<?php

// src/EventListener/S3UploaderListner.php
namespace App\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\CodesCsvFile;
use Aws\S3\S3Client;
use Psr\Log\LoggerInterface;

/**
 * S3UploaderListner
 */
class S3UploaderListner
{
	private $params;
	private $logger;
	private $awskey;
	private $awssecret;

	public function __construct($awskey, $awssecret, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->awskey = $awskey;
        $this->awssecret = $awssecret;
    }

	public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof CodesCsvFile) 
        {
            //Upload file codes to AWS S3 server
            // Instantiate an Amazon S3 client.
			$s3 = new S3Client([
			    'version' => 'latest',
			    'region'  => 'us-west-2'
			]);

			$this->logger->info($this->awskey);
			$this->logger->info($this->awssecret);
			//$this->logger->info('<pre>'.print_r($s3,1).'</pre>');

        	//throw new \Exception('Upload action');
        }
    }
}