<?php

namespace Bildvitta\IssVendas;

use Bildvitta\IssVendas\Contracts\IssVendasFactory;
use Bildvitta\IssVendas\Resources\Sale;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\Pure;

class IssVendas implements IssVendasFactory
{
    public PendingRequest $request;

    private ?string $token;

    public function __construct(?string $token = '')
    {
        parent::__construct();

        $programmatic = true;
        if ($token != '') {
            $programmatic = false;
        }

        $this->setToken($token, $programmatic);
    }

    public function setToken(string $token, bool $programmatic = false)
    {
        $this->token = $token;

        if ($programmatic) {
            $clientId = Config::get('hub.programatic_access.client_id');
            if (Cache::has($clientId)) {
                $accessToken = Cache::get($clientId);
            } else {
                $accessToken = $this->getToken();
                Cache::add($clientId, $accessToken, now()->addSeconds(31536000));
            }
            $this->token = $accessToken;
        }

        $this->prepareRequest();

        return $this;
    }

    private function getToken()
    {
        $hubUrl = Config::get('hub.base_uri').Config::get('hub.oauth.token_uri');
        $clientId = Config::get('hub.programatic_access.client_id');
        $secretId = Config::get('hub.programatic_access.client_secret');
        $response = Http::asForm()->post($hubUrl, [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $secretId,
            'scope' => '*',
        ]);

        return $response->json('access_token');
    }

    private function prepareRequest(): PendingRequest
    {
        return $this->request = Http::withToken($this->token)
            ->baseUrl(Config::get('iss-juridico.base_uri').Config::get('iss-juridico.prefix'))
            ->withOptions(self::DEFAULT_OPTIONS)
            ->withHeaders($this->getHeaders());
    }

    public function getHeaders()
    {
        return array_merge(
            self::DEFAULT_HEADERS,
            [
                'Almobi-Host' => Config::get('app.slug', ''),
            ]
        );
    }

    /**
     * @return Sale
     */
    public function sale(): Sale
    {
        return new Sale($this);
    }

    /**
     * @return Programmatic
     */
    public function programmatic(): Programmatic
    {
        return new Programmatic($this);
    }
}
