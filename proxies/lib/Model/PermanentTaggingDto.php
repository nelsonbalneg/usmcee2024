<?php
/**
 * PermanentTaggingDto
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

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * PermanentTaggingDto Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PermanentTaggingDto implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PermanentTaggingDto';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'student_no' => 'string',
        'campus_id' => 'int',
        'term_id' => 'int',
        'tag' => 'string',
        'tagged' => 'bool',
        'tagged_by' => 'string',
        'date_tagged' => '\DateTime',
        'modified' => '\DateTime',
        'modofied_by' => 'string',
        'remarks' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => 'int32',
        'student_no' => null,
        'campus_id' => 'int32',
        'term_id' => 'int32',
        'tag' => null,
        'tagged' => null,
        'tagged_by' => null,
        'date_tagged' => 'date-time',
        'modified' => 'date-time',
        'modofied_by' => null,
        'remarks' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'student_no' => true,
        'campus_id' => false,
        'term_id' => false,
        'tag' => true,
        'tagged' => false,
        'tagged_by' => true,
        'date_tagged' => false,
        'modified' => false,
        'modofied_by' => true,
        'remarks' => true
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'student_no' => 'studentNo',
        'campus_id' => 'campusId',
        'term_id' => 'termId',
        'tag' => 'tag',
        'tagged' => 'tagged',
        'tagged_by' => 'taggedBy',
        'date_tagged' => 'dateTagged',
        'modified' => 'modified',
        'modofied_by' => 'modofiedBy',
        'remarks' => 'remarks'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'student_no' => 'setStudentNo',
        'campus_id' => 'setCampusId',
        'term_id' => 'setTermId',
        'tag' => 'setTag',
        'tagged' => 'setTagged',
        'tagged_by' => 'setTaggedBy',
        'date_tagged' => 'setDateTagged',
        'modified' => 'setModified',
        'modofied_by' => 'setModofiedBy',
        'remarks' => 'setRemarks'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'student_no' => 'getStudentNo',
        'campus_id' => 'getCampusId',
        'term_id' => 'getTermId',
        'tag' => 'getTag',
        'tagged' => 'getTagged',
        'tagged_by' => 'getTaggedBy',
        'date_tagged' => 'getDateTagged',
        'modified' => 'getModified',
        'modofied_by' => 'getModofiedBy',
        'remarks' => 'getRemarks'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('student_no', $data ?? [], null);
        $this->setIfExists('campus_id', $data ?? [], null);
        $this->setIfExists('term_id', $data ?? [], null);
        $this->setIfExists('tag', $data ?? [], null);
        $this->setIfExists('tagged', $data ?? [], null);
        $this->setIfExists('tagged_by', $data ?? [], null);
        $this->setIfExists('date_tagged', $data ?? [], null);
        $this->setIfExists('modified', $data ?? [], null);
        $this->setIfExists('modofied_by', $data ?? [], null);
        $this->setIfExists('remarks', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id id
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets student_no
     *
     * @return string|null
     */
    public function getStudentNo()
    {
        return $this->container['student_no'];
    }

    /**
     * Sets student_no
     *
     * @param string|null $student_no student_no
     *
     * @return self
     */
    public function setStudentNo($student_no)
    {
        if (is_null($student_no)) {
            array_push($this->openAPINullablesSetToNull, 'student_no');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('student_no', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['student_no'] = $student_no;

        return $this;
    }

    /**
     * Gets campus_id
     *
     * @return int|null
     */
    public function getCampusId()
    {
        return $this->container['campus_id'];
    }

    /**
     * Sets campus_id
     *
     * @param int|null $campus_id campus_id
     *
     * @return self
     */
    public function setCampusId($campus_id)
    {
        if (is_null($campus_id)) {
            throw new \InvalidArgumentException('non-nullable campus_id cannot be null');
        }
        $this->container['campus_id'] = $campus_id;

        return $this;
    }

    /**
     * Gets term_id
     *
     * @return int|null
     */
    public function getTermId()
    {
        return $this->container['term_id'];
    }

    /**
     * Sets term_id
     *
     * @param int|null $term_id term_id
     *
     * @return self
     */
    public function setTermId($term_id)
    {
        if (is_null($term_id)) {
            throw new \InvalidArgumentException('non-nullable term_id cannot be null');
        }
        $this->container['term_id'] = $term_id;

        return $this;
    }

    /**
     * Gets tag
     *
     * @return string|null
     */
    public function getTag()
    {
        return $this->container['tag'];
    }

    /**
     * Sets tag
     *
     * @param string|null $tag tag
     *
     * @return self
     */
    public function setTag($tag)
    {
        if (is_null($tag)) {
            array_push($this->openAPINullablesSetToNull, 'tag');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('tag', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['tag'] = $tag;

        return $this;
    }

    /**
     * Gets tagged
     *
     * @return bool|null
     */
    public function getTagged()
    {
        return $this->container['tagged'];
    }

    /**
     * Sets tagged
     *
     * @param bool|null $tagged tagged
     *
     * @return self
     */
    public function setTagged($tagged)
    {
        if (is_null($tagged)) {
            throw new \InvalidArgumentException('non-nullable tagged cannot be null');
        }
        $this->container['tagged'] = $tagged;

        return $this;
    }

    /**
     * Gets tagged_by
     *
     * @return string|null
     */
    public function getTaggedBy()
    {
        return $this->container['tagged_by'];
    }

    /**
     * Sets tagged_by
     *
     * @param string|null $tagged_by tagged_by
     *
     * @return self
     */
    public function setTaggedBy($tagged_by)
    {
        if (is_null($tagged_by)) {
            array_push($this->openAPINullablesSetToNull, 'tagged_by');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('tagged_by', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['tagged_by'] = $tagged_by;

        return $this;
    }

    /**
     * Gets date_tagged
     *
     * @return \DateTime|null
     */
    public function getDateTagged()
    {
        return $this->container['date_tagged'];
    }

    /**
     * Sets date_tagged
     *
     * @param \DateTime|null $date_tagged date_tagged
     *
     * @return self
     */
    public function setDateTagged($date_tagged)
    {
        if (is_null($date_tagged)) {
            throw new \InvalidArgumentException('non-nullable date_tagged cannot be null');
        }
        $this->container['date_tagged'] = $date_tagged;

        return $this;
    }

    /**
     * Gets modified
     *
     * @return \DateTime|null
     */
    public function getModified()
    {
        return $this->container['modified'];
    }

    /**
     * Sets modified
     *
     * @param \DateTime|null $modified modified
     *
     * @return self
     */
    public function setModified($modified)
    {
        if (is_null($modified)) {
            throw new \InvalidArgumentException('non-nullable modified cannot be null');
        }
        $this->container['modified'] = $modified;

        return $this;
    }

    /**
     * Gets modofied_by
     *
     * @return string|null
     */
    public function getModofiedBy()
    {
        return $this->container['modofied_by'];
    }

    /**
     * Sets modofied_by
     *
     * @param string|null $modofied_by modofied_by
     *
     * @return self
     */
    public function setModofiedBy($modofied_by)
    {
        if (is_null($modofied_by)) {
            array_push($this->openAPINullablesSetToNull, 'modofied_by');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('modofied_by', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['modofied_by'] = $modofied_by;

        return $this;
    }

    /**
     * Gets remarks
     *
     * @return string|null
     */
    public function getRemarks()
    {
        return $this->container['remarks'];
    }

    /**
     * Sets remarks
     *
     * @param string|null $remarks remarks
     *
     * @return self
     */
    public function setRemarks($remarks)
    {
        if (is_null($remarks)) {
            array_push($this->openAPINullablesSetToNull, 'remarks');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('remarks', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['remarks'] = $remarks;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

