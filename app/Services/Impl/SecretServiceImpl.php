<?php

namespace App\Services\Impl;

use App\DTO\SecretDTO;
use App\Models\Secret;
use App\Services\SecretService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Secret Service implementation.
 */
 class SecretServiceImpl implements SecretService
 {
    /**
     * Get Secret by hash
     * 
     * @param string $hash The given hash.
     * @return Secret The Secret model.
     */
    public function getSecretByHash($hash): JsonResponse {
      $actualTime = Carbon::now()->toDateTimeString();
      $secret = Secret::whereHash($hash)
        ->where(function($query) use ($actualTime) {
          $query->orWhere('expiresAt', '>', $actualTime)
            ->orWhere('expiresAt', '=', 0) ;
          })
          ->where('remainingViews', '>', 0)
          ->first();
      
      if ($secret) {
        $secret->decrement('remainingViews');
        $secret->save();
      }
      
      return response()->json($secret);
    }

    /**
     * Save secret
     * 
     * @param SecretDTO $secret The given Secret DTO.
     * @return Secret The saved Secret model.
     */
    public function save(SecretDTO $secret): Secret {
      return Secret::create((array) $secret);
    }
 }