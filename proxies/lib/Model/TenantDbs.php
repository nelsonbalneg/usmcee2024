<?php
/**
 * TenantDbs
 *
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

namespace OpenAPI\Client\Model;
use \OpenAPI\Client\ObjectSerializer;

/**
 * TenantDbs Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class TenantDbs
{
    /**
     * Possible values of this enum
     */
    public const NUMBER_1 = 1;

    public const NUMBER_3 = 3;

    public const NUMBER_4 = 4;

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NUMBER_1,
            self::NUMBER_3,
            self::NUMBER_4
        ];
    }
}

