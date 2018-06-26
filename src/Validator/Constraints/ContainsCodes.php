<?php

// src/Validator/Constraints/ContainsCodes.php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsCodes extends Constraint
{
    public $message = 'The code "{{ string }}" is "{{ status }}".';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
 
    public function validatedBy()
    {
        return 'application_code_validator';
    }

}