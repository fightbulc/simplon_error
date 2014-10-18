<?php

namespace Simplon\Error;

/**
 * ErrorResponse
 * @package Simplon\Error
 * @author Tino Ehrich (tino@bigpun.me)
 */
class ErrorResponse
{
    /**
     * @var int
     */
    private $httpCode;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $code;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return ErrorResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return ErrorResponse
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * @return ErrorResponse
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function requestMalformed($message = 'Request malformed', $code = null, array $data = [])
    {
        $this->setHttpCode(400);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function requestUnauthorised($message = 'Request unauthorised', $code = null, array $data = [])
    {
        $this->setHttpCode(401);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function requestForbidden($message = 'Request forbidden', $code = null, array $data = [])
    {
        $this->setHttpCode(403);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function requestNotFound($message = 'Request not found', $code = null, array $data = [])
    {
        $this->setHttpCode(404);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function requestMethodNotAllowed($message = 'Request method not allowed', $code = null, array $data = [])
    {
        $this->setHttpCode(405);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function requestUnprocessableEntity($message = 'Request unprocessable', $code = null, array $data = [])
    {
        $this->setHttpCode(422);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function internalError($message = 'Internal error', $code = null, array $data = [])
    {
        $this->setHttpCode(500);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function badGateway($message = 'Bad gateway', $code = null, array $data = [])
    {
        $this->setHttpCode(502);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    public function unavailable($message = 'Unavailable', $code = null, array $data = [])
    {
        $this->setHttpCode(503);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param $code
     *
     * @return ErrorResponse
     */
    private function setHttpCode($code)
    {
        $this->httpCode = $code;

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorResponse
     */
    private function setErrorMessage($message = 'Unknown error', $code = null, array $data = [])
    {
        $this->message = $message;
        $this->code = $code;
        $this->data = $data;

        return $this;
    }
}