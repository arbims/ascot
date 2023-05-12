<?php

namespace App\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class contraintsuniquefieldsValidator {
    
    
    public function validate($value , Constraint $constraint){
        
        if(1!=0) $this->context->addViolation($constraint->message);
    }
}
