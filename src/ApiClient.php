<?php

namespace Foxentry;

use Foxentry\Resource\Company;
use Foxentry\Resource\Email;
use Foxentry\Resource\Location;
use Foxentry\Resource\Name;
use Foxentry\Resource\Phone;

/**
 * API client class for interacting with Foxentry API.
 *
 * @package Foxentry
 */
class ApiClient
{
    /**
     * Email resource.
     *
     * @var Email
     */
    public $email;

    /**
     * Location resource.
     *
     * @var Location
     */
    public $location;

    /**
     * Company resource.
     *
     * @var Company
     */
    public $company;

    /**
     * Name resource.
     *
     * @var Name
     */
    public $name;

    /**
     * Phone resource.
     *
     * @var Phone
     */
    public $phone;

    /**
     * Request object for making API requests.
     *
     * @var Request
     */
    private $request;

    /**
     * ApiClient constructor.
     *
     * @param string|null $apiKey The API key for authentication
     */
    public function __construct(?string $apiKey = null)
    {
        $this->request = new Request();

        if(!empty($apiKey))
            $this->request->setAuth($apiKey);

        $this->initializeResources();
    }

    /**
     * Set API key for authentication.
     *
     * @param string $apiKey The API key to set
     */
    public function setAuth(string $apiKey): void
    {
        $this->request->setAuth($apiKey);
    }

    /**
     * Set the API version for requests.
     *
     * @param string $version The API version to set
     */
    public function setApiVersion(string $version): void
    {
        $this->request->setHeader("Api-Version", $version);
    }

    /**
     * Include request details in API responses.
     *
     * @param bool $value Whether to include request details (default: true)
     */
    public function includeRequestDetails(bool $value = true): void
    {
        $this->request->setHeader("Foxentry-Include-Request-Details", $value);
    }

    /**
     * Initialize the API resources.
     */
    private function initializeResources(): void
    {
        $this->company = new Company($this->request);
        $this->email = new Email($this->request);
        $this->location = new Location($this->request);
        $this->name = new Name($this->request);
        $this->phone = new Phone($this->request);
    }
}