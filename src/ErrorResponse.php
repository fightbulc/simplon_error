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
    private $statusCode;

    /**
     * @var ErrorMessage
     */
    private $errorMessage;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $code
     */
    private function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    /**
     * @return ErrorMessage
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    private function setErrorMessage(ErrorMessage $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function requestMalformed(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(400);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function requestUnauthorised(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(401);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function requestForbidden(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(403);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function requestNotFound(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(404);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function requestMethodNotAllowed(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(405);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function internalError(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(500);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function badGateway(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(502);
        $this->setErrorMessage($errorMessage);

        return $this;
    }

    /**
     * @param ErrorMessage $errorMessage
     *
     * @return ErrorResponse
     */
    public function unavailable(ErrorMessage $errorMessage)
    {
        $this->setStatusCode(503);
        $this->setErrorMessage($errorMessage);

        return $this;
    }
}