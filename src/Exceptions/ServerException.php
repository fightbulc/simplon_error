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
     * @param array $data
     *
     * @return $this
     */
    public function unknownError(array $data = [])
    {
        return $this
            ->setHttpStatusCode(self::STATUS_UNKOWN_ERROR)
            ->setMessage('We have no idea what happened but we will be notified and look into the issue.')
            ->setData($data);
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function invalidResponseUpstream(array $data = [])
    {
        return $this
            ->setHttpStatusCode(self::STATUS_INVALID_RESPONSE_UPSTREAM)
            ->setMessage('An upstream server/service responded with an error.')
            ->setData($data);
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function serviceUnavailable(array $data = [])
    {
        return $this
            ->setHttpStatusCode(self::STATUS_SERVICE_UNAVAILABLE)
            ->setMessage('We are currently not available. Check back in a short time.')
            ->setData($data);
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function timeoutUpstream(array $data = [])
    {
        return $this
            ->setHttpStatusCode(self::STATUS_TIMEOUT_UPSTREAM)
            ->setMessage('The requested upstream server/service timed out.')
            ->setData($data);
    }
}