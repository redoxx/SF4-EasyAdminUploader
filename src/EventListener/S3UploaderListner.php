<?php

// src/EventListener/S3UploaderListner.php

namespace App\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\CodesCsvFile;
use Aws\S3\S3Client;
use Psr\Log\LoggerInterface;

/**
 * Class S3UploaderListner
 * 
 * @author Red
 */
class S3UploaderListner
{
	private $params;
	private $logger;
	private $awskey;
	private $awssecret;
	private $bucket;

	public function __construct($awskey, $awssecret, $bucket, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->awskey = $awskey;
        $this->awssecret = $awssecret;
        $this->bucket = $bucket;
    }

	public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof CodesCsvFile) 
        {

            // Upload file codes to AWS S3 server
            // Instantiate an Amazon S3 client.
			$s3 = new S3Client([
			    'version' => 'latest',
			    'region'  => 'us-west-2'
			]);

			$this->logger->info($this->awskey);
			$this->logger->info($this->awssecret);
			/*
			// upload file
			try {
			    $s3->putObject([
			        'Bucket' => $this->bucket,
			        'Key'    => $this->awskey,
			        'Body'   => fopen('/upload/'.$entity->getCsvfile(), 'r'),
			        'ACL'    => 'public-read',
			    ]);
			} catch (Aws\S3\Exception\S3Exception $e) {
				$this->logger->info($e);
			    throw new \Exception('There was an error uploading the file');
			}
			*/

        }
    }
}