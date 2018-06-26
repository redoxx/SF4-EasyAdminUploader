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

	/**
	 * Construct
	 */
	public function __construct($awskey, $awssecret, $awsbucket, $awsendpoint, $dbtable, $dbregion)
    {
        $this->awskey = $awskey;
        $this->awssecret = $awssecret;
        $this->awsbucket = $awsbucket;
        $this->awsendpoint = $awsendpoint;
        $this->dynamotable = $dbtable;
        $this->dbregion = $dbregion;
    }

    /**
	 * validate
	 */
    public function validate($code, Constraint $constraint)
    {
    	$value = $code->getContent();
    	// empty value
    	if (strlen($value) == 0) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', 'value')
                ->setParameter('{{ status }}', 'empty')
                ->addViolation();
        }
        // string escape
        $value = htmlspecialchars($value);

        // validate code format
        if (!preg_match('/^[a-zA-Z0-9]+$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->setParameter('{{ status }}', 'invalid')
                ->addViolation();
        }
        // check code on DynamoDB DB
        $result = $this->AWS_ckeck_code($value);
        switch ($result) {
        	case 'USED':
        		# code...
        		break;
        	case 'NOTEXIST':
        		break;
        	default:
        		# code...
        		break;
        }

    }

    /**
     * Code Checking on AWS DynamoDB
     * @param String $code_value
     */
    public function AWS_ckeck_code($code_value)
    {
        /*
           $sdk = new Aws\Sdk([
            'endpoint'   => 'http://localhost:8000',
            'region'   => 'us-west-2',
            'version'  => 'latest'
        ]);

        $dynamodb = $sdk->createDynamoDb();
        $marshaler = new Marshaler();

        $tableName = 'Movies';

        $year = 2015;
        $title = 'The Big New Movie';

        $key = $marshaler->marshalJson('
            {
                "year": ' . $year . ', 
                "title": "' . $title . '"
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key
        ];

        try {
            $result = $dynamodb->getItem($params);
            print_r($result["Item"]);

        } catch (DynamoDbException $e) {
            echo "Unable to get item:\n";
            echo $e->getMessage() . "\n";
        }
        */
        return TRUE;
    }

}