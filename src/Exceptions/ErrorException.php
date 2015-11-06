<?php

namespace Simplon\Error\Exceptions;

use Exception;

/**
 * Class ErrorException
 * @package Simplon\Error
 */
class ErrorException extends \Exception
{
    /**
     * @var int
     */
    protected $httpStatusCode;

    /**
     * @var array
     */
    protected $publicData = [];

    /**
     * @param Exception $previous
     */
    public function __construct(Exception $previous = null)
    {
        parent::__construct(null, null, $previous);
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @param string $message
     *
     * @return ErrorException
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getPublicData($key = null)
    {
        if ($key)
        {
            if (empty($this->publicData[$key]) === false)
            {
                return $this->publicData[$key];
            }

            return null;
        }

        return $this->publicData;
    }

    /**
     * @param array $publicData
     *
     * @return $this
     */
    public function setPublicData(array $publicData)
    {
        $this->publicData = $publicData;

        return $this;
    }

    /**
     * @param int $code
     *
     * @return $this
     */
    protected function setHttpStatusCode($code)
    {
        $this->httpStatusCode = $code;

        return $this;
    }
}