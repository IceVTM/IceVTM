<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraints\AbstractComparison;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class GoogleTfaToken extends AbstractComparison
{
    public $message = 'This token is not valid.';
}
