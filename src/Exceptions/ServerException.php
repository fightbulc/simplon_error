<?php

namespace Simplon\Error\Exceptions;

/**
 * Class ServerErrorException
 * @package Simplon\Error
 */
class ServerException extends ErrorException
{
    const STATUS_UNKOWN_ERROR = 500;
    const STATUS_INVALID_RESPONSE_UPSTREAM = 502;
    const STATUS_SERVICE_UNAVAILABLE = 503;
    const STATUS_TIMEOUT_UPSTREAM = 504;

    /**
     * @param string $message
     *
     * @return $this
     */
    public function unknownError($message = 'We have no idea what happened but we will be notified and look into the issue.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_UNKOWN_ERROR)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function invalidResponseUpstream($message = 'An upstream server/service responded with an error.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_INVALID_RESPONSE_UPSTREAM)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function serviceUnavailable($message = 'We are currently not available. Check back in a short time.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_SERVICE_UNAVAILABLE)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function timeoutUpstream($message = 'The requested upstream server/service timed out.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_TIMEOUT_UPSTREAM)
            ->setMessage($message);
    }
}