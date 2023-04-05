<?php

namespace Mideal\Jwt;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Mideal\Jwt\Facades\JwtServiceFacade;

class JWTGuard implements Guard
{
    use GuardHelpers;

    /**
     * The name of the query string item from the request containing the API jwt token.
     *
     * @var string
     */
    protected $inputKey;

    protected $storageKeyDatabase;

    protected $storageKeyJwt;

    protected $inputStorage;

    /**
     * Create a new authentication guard.
     */
    public function __construct(UserProvider $provider, protected Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
        $this->storageKeyDatabase = config('jwt.storage_key_database');
        $this->storageKeyJwt = config('jwt.storage_key_jwt');
        $this->inputKey = config('jwt.input_key');
        $this->inputStorage = config('jwt.input_storage');
    }

    /**
     * Get the currently authenticated user.
     *
     */
    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (! is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $jwtToken = $this->getTokenFromRequest();

        if ($jwtToken) {
            $tokenPayload = $this->getTokenPayload($jwtToken);
        }
        $storageKeyJwt = $this->storageKeyJwt;
        if (! empty($tokenPayload->data->$storageKeyJwt)) {
            $user = $this->provider->retrieveByCredentials([
                $this->storageKeyDatabase => $tokenPayload->data->$storageKeyJwt,
            ]);
        }

        return $this->user = $user;
    }

    /**
     * Get the token for the current request.
     */
    public function getTokenFromRequest()
    {
        if ($this->inputStorage == 'cookie') {
            return $this->request->cookie($this->inputKey);
        }

        if ($this->inputStorage == 'bearer_token') {
            return $this->request->bearerToken();
        }

        return null;
    }

    /**
     * Get the creditional from jwt token.
     */
    protected function getTokenPayload(string $token)
    {
        return JwtServiceFacade::decode($token);
    }

    /**
     * Validate a user's credentials.
     */
    public function validate(array $credentials = []): bool
    {
        if (empty($credentials[$this->inputKey])) {
            return false;
        }
        $tokenPayload = $this->getTokenPayload($credentials[$this->inputKey]);
        $storageKeyJwt = $this->storageKeyJwt;
        $credentials = [$this->storageKeyDatabase => $tokenPayload->data->$storageKeyJwt];

        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * Set the current request instance.
     */
    protected function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }
}
