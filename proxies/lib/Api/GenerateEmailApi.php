<?php
/**
 * GenerateEmailApi
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
 * GenerateEmailApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class GenerateEmailApi
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
        'apiV2GenerateEmailGet' => [
            'application/json',
        ],
        'apiV2GenerateEmailRegenEmailPost' => [
            'application/json',
        ],
        'apiV2GenerateEmailRegenEmailStudentNoRepsPost' => [
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
     * Operation apiV2GenerateEmailGet
     *
     * @param  string $lastname lastname (optional)
     * @param  string $firstname firstname (optional)
     * @param  string $middle middle (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2GenerateEmailGet($lastname = null, $firstname = null, $middle = null, string $contentType = self::contentTypes['apiV2GenerateEmailGet'][0])
    {
        $this->apiV2GenerateEmailGetWithHttpInfo($lastname, $firstname, $middle, $contentType);
    }

    /**
     * Operation apiV2GenerateEmailGetWithHttpInfo
     *
     * @param  string $lastname (optional)
     * @param  string $firstname (optional)
     * @param  string $middle (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailGet'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2GenerateEmailGetWithHttpInfo($lastname = null, $firstname = null, $middle = null, string $contentType = self::contentTypes['apiV2GenerateEmailGet'][0])
    {
        $request = $this->apiV2GenerateEmailGetRequest($lastname, $firstname, $middle, $contentType);

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
     * Operation apiV2GenerateEmailGetAsync
     *
     * @param  string $lastname (optional)
     * @param  string $firstname (optional)
     * @param  string $middle (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2GenerateEmailGetAsync($lastname = null, $firstname = null, $middle = null, string $contentType = self::contentTypes['apiV2GenerateEmailGet'][0])
    {
        return $this->apiV2GenerateEmailGetAsyncWithHttpInfo($lastname, $firstname, $middle, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2GenerateEmailGetAsyncWithHttpInfo
     *
     * @param  string $lastname (optional)
     * @param  string $firstname (optional)
     * @param  string $middle (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2GenerateEmailGetAsyncWithHttpInfo($lastname = null, $firstname = null, $middle = null, string $contentType = self::contentTypes['apiV2GenerateEmailGet'][0])
    {
        $returnType = '';
        $request = $this->apiV2GenerateEmailGetRequest($lastname, $firstname, $middle, $contentType);

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
     * Create request for operation 'apiV2GenerateEmailGet'
     *
     * @param  string $lastname (optional)
     * @param  string $firstname (optional)
     * @param  string $middle (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2GenerateEmailGetRequest($lastname = null, $firstname = null, $middle = null, string $contentType = self::contentTypes['apiV2GenerateEmailGet'][0])
    {





        $resourcePath = '/api/v2/GenerateEmail';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lastname,
            'lastname', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $firstname,
            'firstname', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $middle,
            'middle', // param base name
            'string', // openApiType
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
     * Operation apiV2GenerateEmailRegenEmailPost
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id tenant_id (optional)
     * @param  string $idprefix idprefix (optional, default to '24-')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailPost'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2GenerateEmailRegenEmailPost($tenant_id = null, $idprefix = '24-', string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailPost'][0])
    {
        $this->apiV2GenerateEmailRegenEmailPostWithHttpInfo($tenant_id, $idprefix, $contentType);
    }

    /**
     * Operation apiV2GenerateEmailRegenEmailPostWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $idprefix (optional, default to '24-')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailPost'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2GenerateEmailRegenEmailPostWithHttpInfo($tenant_id = null, $idprefix = '24-', string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailPost'][0])
    {
        $request = $this->apiV2GenerateEmailRegenEmailPostRequest($tenant_id, $idprefix, $contentType);

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
     * Operation apiV2GenerateEmailRegenEmailPostAsync
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $idprefix (optional, default to '24-')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2GenerateEmailRegenEmailPostAsync($tenant_id = null, $idprefix = '24-', string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailPost'][0])
    {
        return $this->apiV2GenerateEmailRegenEmailPostAsyncWithHttpInfo($tenant_id, $idprefix, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2GenerateEmailRegenEmailPostAsyncWithHttpInfo
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $idprefix (optional, default to '24-')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2GenerateEmailRegenEmailPostAsyncWithHttpInfo($tenant_id = null, $idprefix = '24-', string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailPost'][0])
    {
        $returnType = '';
        $request = $this->apiV2GenerateEmailRegenEmailPostRequest($tenant_id, $idprefix, $contentType);

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
     * Create request for operation 'apiV2GenerateEmailRegenEmailPost'
     *
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $idprefix (optional, default to '24-')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2GenerateEmailRegenEmailPostRequest($tenant_id = null, $idprefix = '24-', string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailPost'][0])
    {




        $resourcePath = '/api/v2/GenerateEmail/regen-email';
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
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $idprefix,
            'idprefix', // param base name
            'string', // openApiType
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiV2GenerateEmailRegenEmailStudentNoRepsPost
     *
     * @param  string $student_no student_no (required)
     * @param  int $reps reps (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiV2GenerateEmailRegenEmailStudentNoRepsPost($student_no, $reps, $tenant_id = null, string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'][0])
    {
        $this->apiV2GenerateEmailRegenEmailStudentNoRepsPostWithHttpInfo($student_no, $reps, $tenant_id, $contentType);
    }

    /**
     * Operation apiV2GenerateEmailRegenEmailStudentNoRepsPostWithHttpInfo
     *
     * @param  string $student_no (required)
     * @param  int $reps (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiV2GenerateEmailRegenEmailStudentNoRepsPostWithHttpInfo($student_no, $reps, $tenant_id = null, string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'][0])
    {
        $request = $this->apiV2GenerateEmailRegenEmailStudentNoRepsPostRequest($student_no, $reps, $tenant_id, $contentType);

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
     * Operation apiV2GenerateEmailRegenEmailStudentNoRepsPostAsync
     *
     * @param  string $student_no (required)
     * @param  int $reps (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2GenerateEmailRegenEmailStudentNoRepsPostAsync($student_no, $reps, $tenant_id = null, string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'][0])
    {
        return $this->apiV2GenerateEmailRegenEmailStudentNoRepsPostAsyncWithHttpInfo($student_no, $reps, $tenant_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiV2GenerateEmailRegenEmailStudentNoRepsPostAsyncWithHttpInfo
     *
     * @param  string $student_no (required)
     * @param  int $reps (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiV2GenerateEmailRegenEmailStudentNoRepsPostAsyncWithHttpInfo($student_no, $reps, $tenant_id = null, string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'][0])
    {
        $returnType = '';
        $request = $this->apiV2GenerateEmailRegenEmailStudentNoRepsPostRequest($student_no, $reps, $tenant_id, $contentType);

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
     * Create request for operation 'apiV2GenerateEmailRegenEmailStudentNoRepsPost'
     *
     * @param  string $student_no (required)
     * @param  int $reps (required)
     * @param  \OpenAPI\Client\Model\TenantDbs $tenant_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiV2GenerateEmailRegenEmailStudentNoRepsPostRequest($student_no, $reps, $tenant_id = null, string $contentType = self::contentTypes['apiV2GenerateEmailRegenEmailStudentNoRepsPost'][0])
    {

        // verify the required parameter 'student_no' is set
        if ($student_no === null || (is_array($student_no) && count($student_no) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $student_no when calling apiV2GenerateEmailRegenEmailStudentNoRepsPost'
            );
        }

        // verify the required parameter 'reps' is set
        if ($reps === null || (is_array($reps) && count($reps) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $reps when calling apiV2GenerateEmailRegenEmailStudentNoRepsPost'
            );
        }



        $resourcePath = '/api/v2/GenerateEmail/regen-email/{studentNo}/{reps}';
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
        if ($student_no !== null) {
            $resourcePath = str_replace(
                '{' . 'studentNo' . '}',
                ObjectSerializer::toPathValue($student_no),
                $resourcePath
            );
        }
        // path params
        if ($reps !== null) {
            $resourcePath = str_replace(
                '{' . 'reps' . '}',
                ObjectSerializer::toPathValue($reps),
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