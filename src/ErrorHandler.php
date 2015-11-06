<?php

namespace Simplon\Error;

use Simplon\Error\Exceptions\ErrorException;
use Simplon\Error\Exceptions\ServerException;

/**
 * ErrorHandler
 * @package Simplon\Error
 * @author  Tino Ehrich (tino@bigpun.me)
 */
class ErrorHandler
{
    /**
     * @param \Closure $responseHandler
     * @param string $errorMessage
     * @param string $errorType
     *
     * @return bool
     */
    public static function handleScriptErrors(\Closure $responseHandler, $errorMessage = 'An internal error occured', $errorType = 'ERR_SCRIPT')
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($responseHandler, $errorMessage, $errorType)
        {
            switch ($errno)
            {
                case E_USER_ERROR:
                    $data = [
                        'message' => $errstr,
                        'code'    => null,
                        'data'    => [
                            'type' => 'ERROR',
                            'file' => $errfile,
                            'line' => $errline,
                        ],
                    ];
                    break;

                case E_USER_WARNING:
                    $data = [
                        'message' => "WARNING: $errstr",
                        'code'    => $errno,
                        'data'    => [
                            'type' => 'WARNING',
                        ],
                    ];
                    break;

                case E_USER_NOTICE:
                    $data = [
                        'message' => $errstr,
                        'code'    => $errno,
                        'data'    => [
                            'type' => 'NOTICE',
                        ],
                    ];
                    break;

                default:
                    $data = [
                        'message' => $errstr,
                        'code'    => null,
                        'data'    => [
                            'type' => 'UNKNOWN',
                            'file' => $errfile,
                            'line' => $errline,
                        ],
                    ];
                    break;
            }

            // handle content distribution
            echo $responseHandler(new ErrorContext($errorMessage, $errorType, $data));

            exit;
        });

        return true;
    }

    /**
     * @param \Closure $responseHandler
     * @param string $errorMessage
     * @param string $errorType
     *
     * @return bool
     */
    public static function handleFatalErrors(\Closure $responseHandler, $errorMessage = 'Fatal error', $errorType = 'ERR_FATAL')
    {
        ini_set('display_errors', 0);

        register_shutdown_function(function () use ($responseHandler, $errorMessage, $errorType)
        {
            $lastError = error_get_last();

            if ($lastError !== null)
            {
                $errno = $lastError['type'];
                $errstr = $lastError['message'];
                $errfile = $lastError['file'];
                $errline = $lastError['line'];

                $data = [
                    'message' => $errstr,
                    'code'    => $errno,
                    'data'    => [
                        'file' => $errfile,
                        'line' => $errline,
                    ],
                ];

                // handle content distribution
                echo $responseHandler(new ErrorContext($errorMessage, $errorType, $data));

                exit;
            }
        });

        return true;
    }

    /**
     * @param \Closure $responseHandler
     * @param string $errorMessage
     * @param string $errorType
     *
     * @return bool
     */
    public static function handleExceptions(\Closure $responseHandler, $errorMessage = 'An exception occured', $errorType = 'ERR_EXCEPTION')
    {
        set_exception_handler(function (\Exception $e) use ($responseHandler, $errorMessage, $errorType)
        {
            $httpStatusCode = ServerException::STATUS_INTERNAL_ERROR;
            $data = [];

            if ($e instanceof ErrorException)
            {
                $httpStatusCode = $e->getHttpStatusCode();
                $errorMessage = $e->getMessage();
                $data = $e->getPublicData();
            }
            else
            {
                $data['reason'] = $e->getMessage();
            }

            if ($e instanceof ServerException)
            {
                $data['file'] = $e->getFile() . ':' . $e->getLine();
                $data['trace'] = $e->getTrace();
            }

            // handle content distribution
            echo $responseHandler(new ErrorContext($errorMessage, $errorType, $data, $httpStatusCode));

            exit;
        });

        return true;
    }
}