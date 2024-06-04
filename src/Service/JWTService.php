<?php
namespace App\Service;

use DateTimeImmutable;

class JWTService
{
    // we generate the token

    /**
     * Genarate JWT
     * @param array $header
     * @param array $payload
     * @param string $secret
     * @param int $validity
     * @return string
     */
    public function generate(array $header, array $payload, string $secret, int $validity = 10800): string
    {
        if($validity > 0){
            $now = new DateTimeImmutable();
            $exp = $now->getTimestamp() + $validity;

            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $exp;
        }

        // we encode in base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        // we “clean” the encoded values ​​(removal of +, / and =)
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        // we generate the signature
        $secret = base64_encode($secret);

        $signature = hash_hmac('sha256', $base64Header . '.' . $base64Payload, $secret, true);

        $base64Signature = base64_encode($signature);

        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        // we create the token
        $jwt = $base64Header . '.' . $base64Payload . '.' . $base64Signature;

        return $jwt;
    }

    // we check that the token is valid (correctly formed)

    public function isValid(string $token): bool
    {
        return preg_match(
                '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/',
                $token
            ) === 1;
    }

    // we recover the Payload
    public function getPayload(string $token): array
    {
        // we eplode the token
        $array = explode('.', $token);

        // we decode the Payload
        $payload = json_decode(base64_decode($array[1]), true);

        return $payload;
    }

    // we recover the Header
    public function getHeader(string $token): array
    {
        // we explode the token
        $array = explode('.', $token);

        // we encode the Header
        $header = json_decode(base64_decode($array[0]), true);

        return $header;
    }

    // we check if the token has expired
    public function isExpired(string $token): bool
    {
        $payload = $this->getPayload($token);

        $now = new DateTimeImmutable();

        return $payload['exp'] < $now->getTimestamp();
    }

    // we verify the signature of the Token
    public function check(string $token, string $secret)
    {
        // we recover the header and the payload
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

        // we genarate a token
        $verifToken = $this->generate($header, $payload, $secret, 0);

        return $token === $verifToken;
    }


}