<?php
/**
 * AyTermsApi
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
 * AyTermsApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class AyTermsApi
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
        'apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet' => [
            'application/json',
        ],
        'apiV2AyTermsListGet' => [
            'application/json',
        ],
        'apiV2AyTermsListViewGet' => [
            'application/json',
        ],
        'getAyTerms' => [
            'application/json',
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
     * Operation apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet
     *
     * @param  int $term_id term_id (required)
     * @param  int $campus_id campus_id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet($term_id, $campus_id, $tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'][0])
    {
        $this->apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetWithHttpInfo($term_id, $campus_id, $tenant_id, $contentType);
    }

    /**
     * Operation apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetWithHttpInfo
     *
     * @param  int $term_id (required)
     * @param  int $campus_id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetWithHttpInfo($term_id, $campus_id, $tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'][0])
    {
        $request = $this->apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetRequest($term_id, $campus_id, $tenant_id, $contentType);

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
     * Operation apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetAsync
     *
     * @param  int $term_id (required)
     * @param  int $campus_id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetAsync($term_id, $campus_id, $tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'][0])
    {
        return $this->apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetAsyncWithHttpInfo($term_id, $campus_id, $tenant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetAsyncWithHttpInfo
     *
     * @param  int $term_id (required)
     * @param  int $campus_id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetAsyncWithHttpInfo($term_id, $campus_id, $tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'][0])
    {
        $returnType = '';
        $request = $this->apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetRequest($term_id, $campus_id, $tenant_id, $contentType);

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
     * Create request for operation 'apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'
     *
     * @param  int $term_id (required)
     * @param  int $campus_id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGetRequest($term_id, $campus_id, $tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'][0])
    {

        // verify the required parameter 'term_id' is set
        if ($term_id === null || (is_array($term_id) && count($term_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $term_id when calling apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'
            );
        }

        // verify the required parameter 'campus_id' is set
        if ($campus_id === null || (is_array($campus_id) && count($campus_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campus_id when calling apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet'
            );
        }



        $resourcePath = '/api/v2/AyTerms/GetAYTermConfig/{termId}/campus/{campusId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tenant_id,
            'tenantId', // param base name
            'TenantDbs', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($term_id !== null) {
            $resourcePath = str_replace(
                '{' . 'termId' . '}',
                ObjectSerializer::toPathValue($term_id),
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
     * Operation apiV2AyTermsListGet
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2AyTermsListGet($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListGet'][0])
    {
        $this->apiV2AyTermsListGetWithHttpInfo($tenant_id, $contentType);
    }

    /**
     * Operation apiV2AyTermsListGetWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2AyTermsListGetWithHttpInfo($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListGet'][0])
    {
        $request = $this->apiV2AyTermsListGetRequest($tenant_id, $contentType);

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
     * Operation apiV2AyTermsListGetAsync
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2AyTermsListGetAsync($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListGet'][0])
    {
        return $this->apiV2AyTermsListGetAsyncWithHttpInfo($tenant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2AyTermsListGetAsyncWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2AyTermsListGetAsyncWithHttpInfo($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListGet'][0])
    {
        $returnType = '';
        $request = $this->apiV2AyTermsListGetRequest($tenant_id, $contentType);

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
     * Create request for operation 'apiV2AyTermsListGet'
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2AyTermsListGetRequest($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListGet'][0])
    {



        $resourcePath = '/api/v2/AyTerms/list';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tenant_id,
            'tenantId', // param base name
            'TenantDbs', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




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
     * Operation apiV2AyTermsListViewGet
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListViewGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2AyTermsListViewGet($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListViewGet'][0])
    {
        $this->apiV2AyTermsListViewGetWithHttpInfo($tenant_id, $contentType);
    }

    /**
     * Operation apiV2AyTermsListViewGetWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListViewGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2AyTermsListViewGetWithHttpInfo($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListViewGet'][0])
    {
        $request = $this->apiV2AyTermsListViewGetRequest($tenant_id, $contentType);

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
     * Operation apiV2AyTermsListViewGetAsync
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListViewGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2AyTermsListViewGetAsync($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListViewGet'][0])
    {
        return $this->apiV2AyTermsListViewGetAsyncWithHttpInfo($tenant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2AyTermsListViewGetAsyncWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListViewGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2AyTermsListViewGetAsyncWithHttpInfo($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListViewGet'][0])
    {
        $returnType = '';
        $request = $this->apiV2AyTermsListViewGetRequest($tenant_id, $contentType);

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
     * Create request for operation 'apiV2AyTermsListViewGet'
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2AyTermsListViewGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2AyTermsListViewGetRequest($tenant_id = null, string $contentType = self::contentTypes['apiV2AyTermsListViewGet'][0])
    {



        $resourcePath = '/api/v2/AyTerms/list-view';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tenant_id,
            'tenantId', // param base name
            'TenantDbs', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




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
     * Operation getAyTerms
     *
     * @param  int $id id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getAyTerms'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function getAyTerms($id, $tenant_id = null, string $contentType = self::contentTypes['getAyTerms'][0])
    {
        $this->getAyTermsWithHttpInfo($id, $tenant_id, $contentType);
    }

    /**
     * Operation getAyTermsWithHttpInfo
     *
     * @param  int $id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getAyTerms'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAyTermsWithHttpInfo($id, $tenant_id = null, string $contentType = self::contentTypes['getAyTerms'][0])
    {
        $request = $this->getAyTermsRequest($id, $tenant_id, $contentType);

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
     * Operation getAyTermsAsync
     *
     * @param  int $id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getAyTerms'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAyTermsAsync($id, $tenant_id = null, string $contentType = self::contentTypes['getAyTerms'][0])
    {
        return $this->getAyTermsAsyncWithHttpInfo($id, $tenant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAyTermsAsyncWithHttpInfo
     *
     * @param  int $id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getAyTerms'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAyTermsAsyncWithHttpInfo($id, $tenant_id = null, string $contentType = self::contentTypes['getAyTerms'][0])
    {
        $returnType = '';
        $request = $this->getAyTermsRequest($id, $tenant_id, $contentType);

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
     * Create request for operation 'getAyTerms'
     *
     * @param  int $id (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getAyTerms'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getAyTermsRequest($id, $tenant_id = null, string $contentType = self::contentTypes['getAyTerms'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getAyTerms'
            );
        }



        $resourcePath = '/api/v2/AyTerms/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tenant_id,
            'tenantId', // param base name
            'TenantDbs', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
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