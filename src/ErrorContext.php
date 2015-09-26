<?php

namespace Simplon\Error;

use Simplon\Error\Exceptions\ServerException;

/**
 * Class ErrorContext
 * @package Simplon\Error
 */
class ErrorContext
{
    /**
     * @var int
     */
    private $httpStatusCode;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param string $message
     * @param string $type
     * @param array $data
     * @param int $httpStatusCode
     */
    public function __construct($message, $type, array $data = [], $httpStatusCode = ServerException::STATUS_INTERNAL_ERROR)
    {
        $this->message = $message;
        $this->type = $type;
        $this->data = $data;
        $this->httpStatusCode = $httpStatusCode;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function hasType()
    {
        return empty($this->type) === false;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return empty($this->data) === false;
    }
}