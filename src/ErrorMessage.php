<?php

namespace Simplon\Error;

/**
 * ErrorMessage
 * @package Simplon\Error
 * @author Tino Ehrich (tino@bigpun.me)
 */
class ErrorMessage
{
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
     * @param string $message
     * @param string $code
     * @param array $data
     */
    public function __construct($message, $code, array $data = [])
    {
        $this->message = $message;
        $this->code = $code;
        $this->data = $data;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}