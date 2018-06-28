<?php

// src/Validator/Constraints/ContainsCodesValidator.php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

class ContainsCodesValidator extends ConstraintValidator
{
	private $awskey;
	private $awssecret;
	private $awsbucket;
	private $awsendpoint;
	private $dynamotable;
	private $dbregion;
	private $request;
	private $logger;

	/**
	 * Construct
	 */
	public function __construct($awskey,$awssecret,$awsbucket,$awsendpoint,$dbtable,$dbregion,$logger,$request)
    {
        $this->awskey = $awskey;
        $this->awssecret = $awssecret;
        $this->awsbucket = $awsbucket;
        $this->awsendpoint = $awsendpoint;
        $this->dynamotable = $dbtable;
        $this->dbregion = $dbregion;
        $this->logger = $logger;
        $this->request = $request;
    }

    /**
	 * validate
	 */
    public function validate($code, Constraint $constraint)
    {
    	$value = $code->getContent();
    	// string escape
        $value = htmlspecialchars($value);
    	// empty value
    	if (strlen($value) == 0) {
    		$this->get_validation_message('value','empty',$constraint);
        }else if (!preg_match('/^[a-zA-Z0-9]+$/', $value, $matches)) {
        	// validate code format
        	$this->get_validation_message($value,'invalid',$constraint);
        }else{
        	// @TODO check code on DynamoDB
        	$result = $this->AWS_ckeck_code($value);
	        if (empty($result)){
	        	// @TODO uncomment ligne bellow after test
	        	//$this->get_validation_message($value,'nonexistent',$constraint);

	        	// add log to be used by Fail2ban (cf Fail2ban config) 
	        	$ipAddress = $this->request->getCurrentRequest()->getClientIp();
        		$this->logger->error('[BNEE] Redeem code failed for IP: ' . $ipAddress);

	        }else{
	        	// @TODO retreive code detail: already user, validation date or .... 
	        	//$result["Item"]
	        }
        }
        
    }

    /**
     * Code Checking on AWS DynamoDB
     * 
     * @param String $code_value
     * @return Array $code_info
     */
    public function AWS_ckeck_code($code_value)
    {
    	$code_info = [];
        /*
        $sdk = new Aws\Sdk([
            'endpoint'	=> $this->awsendpoint,
            'region'	=> $this->dbregion,
            'version'	=> 'latest'
        ]);

        $dynamodb = $sdk->createDynamoDb();
        $marshaler = new Marshaler();

        $tableName = $this->dynamotable;
        $key = $marshaler->marshalJson('
            {
                "code": "' . $code_value . '"
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key
        ];

        try {
            $result = $dynamodb->getItem($params);
            $code_info = $result["Item"];
            //print_r($result["Item"]);

        } catch (DynamoDbException $e) {
            //echo "Unable to get item:\n";
            //echo $e->getMessage() . "\n";
        }
        */
        return $code_info;
    }

    /**
	* validation message factory
    */
    public function get_validation_message($code,$text,$constraint){
    	return $this->context->buildViolation($constraint->message)
	                ->setParameter('{{ string }}', $code)
	                ->setParameter('{{ status }}', $text)
	                ->addViolation();
	}

}