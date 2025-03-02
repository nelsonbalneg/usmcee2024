<?php
/**
 * EconUsersApi
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * USM Academic Systems Integration Api
 *
 * Integration API for multiple legacy systems and web apps
 *
 * The version of the OpenAPI document: 2.0
 * Contact: rbsgaridan@usm.edu.ph
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.9.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * EconUsersApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EconUsersApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet' => [
            'application/json',
        ],
        'apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet' => [
            'application/json',
        ],
        'apiV2EconUsersLoginPost' => [
            'application/json-patch+json; x-api-version=2.0',
            'application/json; x-api-version=2.0',
            'text/json; x-api-version=2.0',
            'application/*+json; x-api-version=2.0',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet
     *
     * Get all programs under the employee
     *
     * @param  string $employee_id  (required)
     * @param  int $campus_id  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet($employee_id, $campus_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'][0])
    {
        $this->apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetWithHttpInfo($employee_id, $campus_id, $contentType);
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetWithHttpInfo
     *
     * Get all programs under the employee
     *
     * @param  string $employee_id  (required)
     * @param  int $campus_id  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetWithHttpInfo($employee_id, $campus_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'][0])
    {
        $request = $this->apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetRequest($employee_id, $campus_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetAsync
     *
     * Get all programs under the employee
     *
     * @param  string $employee_id  (required)
     * @param  int $campus_id  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetAsync($employee_id, $campus_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'][0])
    {
        return $this->apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetAsyncWithHttpInfo($employee_id, $campus_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetAsyncWithHttpInfo
     *
     * Get all programs under the employee
     *
     * @param  string $employee_id  (required)
     * @param  int $campus_id  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetAsyncWithHttpInfo($employee_id, $campus_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'][0])
    {
        $returnType = '';
        $request = $this->apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetRequest($employee_id, $campus_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'
     *
     * @param  string $employee_id  (required)
     * @param  int $campus_id  (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGetRequest($employee_id, $campus_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'][0])
    {

        // verify the required parameter 'employee_id' is set
        if ($employee_id === null || (is_array($employee_id) && count($employee_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $employee_id when calling apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'
            );
        }

        // verify the required parameter 'campus_id' is set
        if ($campus_id === null || (is_array($campus_id) && count($campus_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campus_id when calling apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet'
            );
        }


        $resourcePath = '/api/v2/EconUsers/{employeeId}/programPolicies/campus/{campusId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($employee_id !== null) {
            $resourcePath = str_replace(
                '{' . 'employeeId' . '}',
                ObjectSerializer::toPathValue($employee_id),
                $resourcePath
            );
        }
        // path params
        if ($campus_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campusId' . '}',
                ObjectSerializer::toPathValue($campus_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet
     *
     * @param  string $employee_id employee_id (required)
     * @param  int $tenant_id tenant_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet($employee_id, $tenant_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'][0])
    {
        $this->apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetWithHttpInfo($employee_id, $tenant_id, $contentType);
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetWithHttpInfo
     *
     * @param  string $employee_id (required)
     * @param  int $tenant_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetWithHttpInfo($employee_id, $tenant_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'][0])
    {
        $request = $this->apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetRequest($employee_id, $tenant_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetAsync
     *
     * @param  string $employee_id (required)
     * @param  int $tenant_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetAsync($employee_id, $tenant_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'][0])
    {
        return $this->apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetAsyncWithHttpInfo($employee_id, $tenant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetAsyncWithHttpInfo
     *
     * @param  string $employee_id (required)
     * @param  int $tenant_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetAsyncWithHttpInfo($employee_id, $tenant_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'][0])
    {
        $returnType = '';
        $request = $this->apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetRequest($employee_id, $tenant_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'
     *
     * @param  string $employee_id (required)
     * @param  int $tenant_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGetRequest($employee_id, $tenant_id, string $contentType = self::contentTypes['apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'][0])
    {

        // verify the required parameter 'employee_id' is set
        if ($employee_id === null || (is_array($employee_id) && count($employee_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $employee_id when calling apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'
            );
        }

        // verify the required parameter 'tenant_id' is set
        if ($tenant_id === null || (is_array($tenant_id) && count($tenant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $tenant_id when calling apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet'
            );
        }


        $resourcePath = '/api/v2/EconUsers/{employeeId}/programPolicies/tenant/{tenantId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($employee_id !== null) {
            $resourcePath = str_replace(
                '{' . 'employeeId' . '}',
                ObjectSerializer::toPathValue($employee_id),
                $resourcePath
            );
        }
        // path params
        if ($tenant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'tenantId' . '}',
                ObjectSerializer::toPathValue($tenant_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiV2EconUsersLoginPost
     *
     * @param  \OpenAPI\Client\Model\UserForLoginDto $user_for_login_dto user_for_login_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersLoginPost'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2EconUsersLoginPost($user_for_login_dto = null, string $contentType = self::contentTypes['apiV2EconUsersLoginPost'][0])
    {
        $this->apiV2EconUsersLoginPostWithHttpInfo($user_for_login_dto, $contentType);
    }

    /**
     * Operation apiV2EconUsersLoginPostWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\UserForLoginDto $user_for_login_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersLoginPost'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2EconUsersLoginPostWithHttpInfo($user_for_login_dto = null, string $contentType = self::contentTypes['apiV2EconUsersLoginPost'][0])
    {
        $request = $this->apiV2EconUsersLoginPostRequest($user_for_login_dto, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation apiV2EconUsersLoginPostAsync
     *
     * @param  \OpenAPI\Client\Model\UserForLoginDto $user_for_login_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersLoginPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2EconUsersLoginPostAsync($user_for_login_dto = null, string $contentType = self::contentTypes['apiV2EconUsersLoginPost'][0])
    {
        return $this->apiV2EconUsersLoginPostAsyncWithHttpInfo($user_for_login_dto, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2EconUsersLoginPostAsyncWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\UserForLoginDto $user_for_login_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersLoginPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2EconUsersLoginPostAsyncWithHttpInfo($user_for_login_dto = null, string $contentType = self::contentTypes['apiV2EconUsersLoginPost'][0])
    {
        $returnType = '';
        $request = $this->apiV2EconUsersLoginPostRequest($user_for_login_dto, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiV2EconUsersLoginPost'
     *
     * @param  \OpenAPI\Client\Model\UserForLoginDto $user_for_login_dto (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2EconUsersLoginPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2EconUsersLoginPostRequest($user_for_login_dto = null, string $contentType = self::contentTypes['apiV2EconUsersLoginPost'][0])
    {



        $resourcePath = '/api/v2/EconUsers/login';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_for_login_dto)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_for_login_dto));
            } else {
                $httpBody = $user_for_login_dto;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
