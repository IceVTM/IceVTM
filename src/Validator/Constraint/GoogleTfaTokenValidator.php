<?php

namespace App\Validator\Constraint;

use Google\Authenticator\GoogleAuthenticator;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\AbstractComparisonValidator;

class GoogleTfaTokenValidator extends AbstractComparisonValidator
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var GoogleAuthenticator
     */
    private $authenticator;

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        PropertyAccessorInterface $propertyAccessor = null
    ) {
        $this->user = $tokenStorage->getToken()->getUser();
        $this->authenticator = new GoogleAuthenticator();

        parent::__construct($propertyAccessor);
    }

    /**
     * @param mixed $value1
     * @param mixed $value2
     * @return bool
     */
    protected function compareValues($value1, $value2)
    {
        return $this->authenticator->checkCode($value2, $value1);
    }
}
