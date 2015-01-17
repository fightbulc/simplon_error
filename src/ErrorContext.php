<?php

namespace Simplon\Error;

/**
 * ErrorContext
 * @package Simplon\Error
 * @author Tino Ehrich (tino@bigpun.me)
 */
class ErrorContext
{
    const CODE_REQUEST_MALFORMED = 400;
    const CODE_REQUEST_UNAUTHORISED = 401;
    const CODE_REQUEST_FORBIDDEN = 403;
    const CODE_REQUEST_NOT_FOUND = 404;
    const CODE_REQUEST_METHOD_NOT_ALLOWED = 405;
    const CODE_REQUEST_WOULD_CAUSE_CONFLICT = 409;
    const CODE_REQUEST_UNPROCESSABLE = 422;
    const CODE_INTERNAL_ERROR = 500;
    const CODE_BAD_GATEWAY = 502;
    const CODE_UNAVAILABLE = 503;

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
     * @return ErrorContext
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
     * @return ErrorContext
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return empty($this->data) === false;
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
     * @return ErrorContext
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
     * @return ErrorContext
     */
    public function requestMalformed($message = 'Request malformed', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_MALFORMED);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function requestUnauthorised($message = 'Request unauthorised', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_UNAUTHORISED);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function requestForbidden($message = 'Request forbidden', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_FORBIDDEN);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function requestNotFound($message = 'Request not found', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_NOT_FOUND);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function requestMethodNotAllowed($message = 'Request method not allowed', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_METHOD_NOT_ALLOWED);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function requestConflict($message = 'Request would cause a conflict', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_WOULD_CAUSE_CONFLICT);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function requestUnprocessableEntity($message = 'Request unprocessable', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_REQUEST_UNPROCESSABLE);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function internalError($message = 'Internal error', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_INTERNAL_ERROR);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function badGateway($message = 'Bad gateway', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_BAD_GATEWAY);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param string $message
     * @param null|string $code
     * @param array $data
     *
     * @return ErrorContext
     */
    public function unavailable($message = 'Unavailable', $code = null, array $data = [])
    {
        $this->setHttpCode(ErrorContext::CODE_UNAVAILABLE);
        $this->setErrorMessage($message, $code, $data);

        return $this;
    }

    /**
     * @param $code
     *
     * @return ErrorContext
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
     * @return ErrorContext
     */
    private function setErrorMessage($message = 'Unknown error', $code = null, array $data = [])
    {
        $this->message = $message;
        $this->code = $code;
        $this->data = $data;

        return $this;
    }
}