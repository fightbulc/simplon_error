<?php

namespace Foo;

use Simplon\Error\ErrorHandler;
use Simplon\Error\ErrorResponse;

class Bar
{
    /**
     * @param ErrorResponse $errorResponse
     *
     * @return string
     */
    private function formatErrorResponse(ErrorResponse $errorResponse)
    {
        // handle the error response
    }

    /**
     * @return void
     */
    private static function handleScriptErrors()
    {
        ErrorHandler::handleScriptErrors(
            function (ErrorResponse $errorResponse) { return self::formatErrorResponse($errorResponse); }
        );
    }

    /**
     * @return void
     */
    private static function handleFatalErrors()
    {
        ErrorHandler::handleFatalErrors(
            function (ErrorResponse $errorResponse) { return self::formatErrorResponse($errorResponse); }
        );
    }

    /**
     * @return void
     */
    private static function handleExceptions()
    {
        ErrorHandler::handleExceptions(
            function (ErrorResponse $errorResponse) { return self::formatErrorResponse($errorResponse); }
        );
    }
}