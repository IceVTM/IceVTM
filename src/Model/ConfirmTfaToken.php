<?php

namespace App\Model;

use App\Validator\Constraint\GoogleTfaToken;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;

class ConfirmTfaToken implements TwoFactorInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     *
     * @GoogleTfaToken(
     *     propertyPath="secret"
     * )
     */
    private $token;

    /**
     * @param string $username
     * @param string $secret
     */
    public function __construct(string $username, string $secret)
    {
        $this->username = $username;
        $this->secret = $secret;
    }

    /**
     * Return true if the user should do two-factor authentication.
     *
     * @return bool
     */
    public function isGoogleAuthenticatorEnabled(): bool
    {
        return true;
    }

    /**
     * Return the user name.
     *
     * @return string
     */
    public function getGoogleAuthenticatorUsername(): string
    {
        return $this->username;
    }

    /**
     * Return the Google Authenticator secret
     * When an empty string or null is returned, the Google authentication is disabled.
     *
     * @return string
     */
    public function getGoogleAuthenticatorSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
