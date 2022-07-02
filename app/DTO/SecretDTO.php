<?php

namespace App\DTO;

/**
 * Secret 
 */
class SecretDTO
{
    /**
     * Secret hash.
     */
    public string $hash;

    /**
     * Secret Text.
     */
    public string $secretText;

    /**
     * Expiring time (minutes)
     */
    public string $expiresAt;

    /**
     * Remaining views
     */
    public string $remainingViews;
}
