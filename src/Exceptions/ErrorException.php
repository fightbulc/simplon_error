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
     * @param array $data
     */
    public function __construct(Exception $previous, array $data = [])
    {
        parent::__construct(null, null, $previous);
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    protected function setMessage($message)
    {
        $this->message = $message;

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