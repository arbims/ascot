<?php
namespace App\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class contraintsuniquefields extends Constraints{
    
    public $message = "champ deja existe";
    
    
} 