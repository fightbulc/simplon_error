<?php

namespace Simplon\Error;

/**
 * ErrorHandler
 * @package Simplon\Error
 * @author  Tino Ehrich (tino@bigpun.me)
 */
class ErrorHandler
{
    /**
     * @param callable $responseHandler
     * @param string   $errorMessage
     * @param string   $errorCode
     *
     * @return bool
     */
    public static function handleScriptErrors(\Closure $responseHandler, $errorMessage = 'An internal error occured', $errorCode = 'ERR_SCRIPT')
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($responseHandler, $errorMessage, $errorCode)
        {
            switch ($errno)
            {
                case E_USER_ERROR:
                    $error = [
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
                    $error = [
                        'message' => "WARNING: $errstr",
                        'code'    => $errno,
                        'data'    => [
                            'type' => 'WARNING'
                        ],
                    ];
                    break;

                case E_USER_NOTICE:
                    $error = [
                        'message' => $errstr,
                        'code'    => $errno,
                        'data'    => [
                            'type' => 'NOTICE',
                        ],
                    ];
                    break;

                default:
                    $error = [
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
            echo $responseHandler(
                (new ErrorContext())->internalError($errorMessage, $errorCode, $error)
            );

            exit;
        });

        return true;
    }

    /**
     * @param callable $responseHandler
     * @param string   $errorMessage
     * @param string   $errorCode
     *
     * @return bool
     */
    public static function handleFatalErrors(\Closure $responseHandler, $errorMessage = 'Fatal error', $errorCode = 'ERR_FATAL')
    {
        ini_set('display_errors', 0);

        register_shutdown_function(function () use ($responseHandler, $errorMessage, $errorCode)
        {
            $lastError = error_get_last();

            if ($lastError !== null)
            {
                $errno = $lastError['type'];
                $errstr = $lastError['message'];
                $errfile = $lastError['file'];
                $errline = $lastError['line'];

                $error = [
                    'message' => $errstr,
                    'code'    => $errno,
                    'data'    => [
                        'file' => $errfile,
                        'line' => $errline,
                    ],
                ];

                // handle content distribution
                echo $responseHandler(
                    (new ErrorContext())->internalError($errorMessage, $errorCode, $error)
                );

                exit;
            }
        });

        return true;
    }

    /**
     * @param callable $responseHandler
     * @param string   $errorMessage
     * @param string   $errorCode
     *
     * @return bool
     */
    public static function handleExceptions(\Closure $responseHandler, $errorMessage = 'An exception occured', $errorCode = 'ERR_EXCEPTION')
    {
        set_exception_handler(function (\Exception $e) use ($responseHandler, $errorMessage, $errorCode)
        {
            // test for json message
            $message = json_decode($e->getMessage(), true);

            // has no json
            if ($message === null)
            {
                $message = $e->getMessage();
            }

            $error = [
                'message' => $message,
                'code'    => $e->getCode(),
                'data'    => [
                    'file'  => $e->getFile(),
                    'line'  => $e->getLine(),
                    'trace' => $e->getTrace(),
                ],
            ];

            // handle content distribution
            echo $responseHandler(
                (new ErrorContext())
                    ->setException($e)
                    ->internalError($errorMessage, $errorCode, $error)
            );

            exit;
        });

        return true;
    }
}