<?php 

namespace App\Services;

use App\DTO\SecretDTO;
use App\Models\Secret;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Secret service
 */
 interface SecretService 
 {

    /**
     * Get Secret by hash
     * 
     * @param string $hash The given hash.
     * @return Secret The Secret model.
     */
    function getSecretByHash(string $hash): JsonResponse;

    /**
     * Save Secret
     * 
     * @param SecretDTO $secret The given Secret DTO.
     * @return Secret The saved Secret model.
     */
    function save(SecretDTO $secret): Secret;
 }