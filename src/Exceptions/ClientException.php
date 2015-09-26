<?php

namespace Simplon\Error\Exceptions;

/**
 * Class ClientException
 * @package Simplon\Error
 */
class ClientException extends ErrorException
{
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_METHOD_NOT_ALLOWED = 405;
    const STATUS_CONTENT_CONFLICT = 409;
    const STATUS_CONTENT_HAS_BEEN_DELETED = 410;
    const STATUS_INVALID_DATA = 422;
    const STATUS_TOO_MANY_REQUESTS = 429;

    /**
     * @param string $message
     *
     * @return $this
     */
    public function cannotUnderstandRequest($message = 'Server could not understand the request due to invalid syntax.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_BAD_REQUEST)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function requestUnauthorized($message = 'Authentication is needed to access requested content.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_UNAUTHORIZED)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function requestForbidden($message = 'Nobody is allowed to access this content.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_FORBIDDEN)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function contentNotFound($message = 'Cannot find your requested content.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_NOT_FOUND)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function requestMethodNotAllowed($message = 'Type of request method is not allowed.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_METHOD_NOT_ALLOWED)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function contentConflict($message = 'The content you are trying to update has changed. Please refresh.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_CONTENT_CONFLICT)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function contentHasBeenDeleted($message = 'The requested content has been deleted.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_CONTENT_HAS_BEEN_DELETED)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function requestHasInvalidData($message = 'Your request data are not valid.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_INVALID_DATA)
            ->setMessage($message);
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function tooManyRequests($message = 'You had too many requests. Please wait for a while and try again later.')
    {
        return $this
            ->setHttpStatusCode(self::STATUS_TOO_MANY_REQUESTS)
            ->setMessage($message);
    }
}