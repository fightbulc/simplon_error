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
    protected $data = [];

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
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

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