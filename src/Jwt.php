<?php

namespace Mideal\Jwt;

use Firebase\JWT\JWT as FierbaseJWT;
use Firebase\JWT\Key;
use stdClass;

class Jwt
{
    private string $password;

    private string $alg;

    public function __construct(string $password, string $alg)
    {
        $this->password = $password;
        $this->alg = $alg;
    }

    public function decode(string $token): stdClass
    {
        return FierbaseJWT::decode($token, $this->getKey());
    }

    public function getKey(): Key
    {
        return new Key($this->encryptKey($this->password), $this->alg);
    }

    public function encryptKey(string $password): string
    {
        return sha1($password);
    }
}
