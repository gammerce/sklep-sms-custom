<?php
namespace App\License;

use App\Requesting\Requester;

class ProxyManagerClient
{
    private Requester $requester;
    private string $baseUrl;

    public function __construct(Requester $requester, string $baseUrl = "http://127.0.0.1:8080")
    {
        $this->requester = $requester;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Reloads nginx configuration with custom sklep sms domains
     */
    public function reload()
    {
        $this->requester->post($this->baseUrl . "/proxy-restart");
    }
}
