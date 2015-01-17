<?php

namespace Foo;

use Simplon\Error\ErrorHandler;
use Simplon\Error\ErrorContext;

class Bar
{
    /**
     * @param ErrorContext $errorResponse
     *
     * @return string
     */
    private function formatErrorResponse(ErrorContext $errorResponse)
    {
        // handle the error response
    }

    /**
     * @return void
     */
    private static function handleScriptErrors()
    {
        ErrorHandler::handleScriptErrors(
            function (ErrorContext $errorResponse) { return self::formatErrorResponse($errorResponse); }
        );
    }

    /**
     * @return void
     */
    private static function handleFatalErrors()
    {
        ErrorHandler::handleFatalErrors(
            function (ErrorContext $errorResponse) { return self::formatErrorResponse($errorResponse); }
        );
    }

    /**
     * @return void
     */
    private static function handleExceptions()
    {
        ErrorHandler::handleExceptions(
            function (ErrorContext $errorResponse) { return self::formatErrorResponse($errorResponse); }
        );
    }
}