<?php

namespace App\Http\Controllers;

use App\DTO\SecretDTO;
use App\Models\Secret;
use App\Services\SecretService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Secret controller
 */
class SecretController extends Controller 
{
    private SecretService $secretService;

    /**
     * Constructor.
     *
     * @param SecretService $secretService
     * @return void
     */
    function __construct(SecretService $secretService)
    {
        $this->secretService = $secretService;
    }

    /**
     * Get secret by hash 
     * 
     * @param string $hash The given hash.
     * @return Secret The Secret model in json or xml type.
     */
    public function getSecretByHash($hash): JsonResponse
    {
        return $this->secretService->getSecretByHash($hash);
    }

    /**
     * Save secret
     * 
     * @param Request $request Request object
     * @return void
     */
    public function save(Request $request) {
        $secretText = $request->secretData['secretText'];
        $secret = new SecretDTO();
        $secret->hash = str_replace('/', '', Hash::make($secretText));
        $secret->secretText = $secretText;
        $secret->expiresAt = $request->secretData['expiresAt'] !== "0" ? Carbon::now()->addMinutes(60) : 0;
        $secret->remainingViews = $request->secretData['remainingViews'];

        $this->secretService->save($secret);
    }
}