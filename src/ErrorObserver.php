<?php

namespace Simplon\Error;

/**
 * Class ErrorObserver
 * @package Simplon\Error
 */
class ErrorObserver
{
    const RESPONSE_HTML = 'html';
    const RESPONSE_JSON = 'json';

    /**
     * @var string
     */
    private $responseType;

    /**
     * @var string
     */
    private $pathErrorTemplate = __DIR__ . '/Templates/error.phtml';

    /**
     * @var \Closure[]
     */
    private $callbacks = [];

    /**
     * @param string $responseType
     */
    public function __construct($responseType)
    {
        $this->responseType = $responseType;
    }

    /**
     * @param string $pathErrorTemplate
     *
     * @return ErrorObserver
     */
    public function setPathErrorTemplate($pathErrorTemplate)
    {
        $this->pathErrorTemplate = $pathErrorTemplate;

        return $this;
    }

    /**
     * @return ErrorObserver
     */
    public function observe()
    {
        $this->observeScriptErrors();
        $this->observeFatalErrors();
        $this->observeExceptions();

        return $this;
    }

    /**
     * @param \Closure $callback
     *
     * @return ErrorObserver
     */
    public function addCallback(\Closure $callback)
    {
        $this->callbacks[] = $callback;

        return $this;
    }

    /**
     * @param ErrorContext $context
     *
     * @return string
     */
    public function handleErrorResponse(ErrorContext $context)
    {
        http_response_code($context->getHttpStatusCode());

        switch ($this->getResponseType())
        {
            case self::RESPONSE_JSON:
                header('Content-type: application/json');

                return $this->handleJsonResponse($context);

            default:
                return $this->handlePhtmlResponse($context);
        }
    }

    /**
     * @return string
     */
    private function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * @param ErrorContext $context
     *
     * @return string
     */
    private function handleJsonResponse(ErrorContext $context)
    {
        $data = [
            'error' => [
                'code'    => $context->getHttpStatusCode(),
                'message' => $context->getMessage(),
            ],
        ];

        // set type
        if ($context->hasType())
        {
            $data['error']['type'] = $context->getType();
        }

        // set data
        if ($context->hasData())
        {
            $data['error']['data'] = $context->getData();
        }

        return json_encode($data);
    }

    /**
     * @param ErrorContext $context
     *
     * @return string
     */
    private function handlePhtmlResponse(ErrorContext $context)
    {
        // start output caching
        ob_start();

        // extract data from array
        extract(['errorContext' => $context]);

        /** @noinspection PhpIncludeInspection */
        require $this->pathErrorTemplate;

        // assign output cache to variable
        $template = ob_get_clean();

        return (string)$template;
    }

    /**
     * @param ErrorContext $context
     *
     * @return ErrorObserver
     */
    private function handleCallbacks(ErrorContext $context)
    {
        foreach ($this->callbacks as $callback)
        {
            $callback($context);
        }

        return $this;
    }

    /**
     * @return ErrorObserver
     */
    private function observeScriptErrors()
    {
        ErrorHandler::handleScriptErrors(
            function (ErrorContext $context)
            {
                $this->handleCallbacks($context);

                return $this->handleErrorResponse($context);
            }
        );

        return $this;
    }

    /**
     * @return ErrorObserver
     */
    private function observeFatalErrors()
    {
        ErrorHandler::handleFatalErrors(
            function (ErrorContext $context)
            {
                $this->handleCallbacks($context);

                return $this->handleErrorResponse($context);
            }
        );

        return $this;
    }

    /**
     * @return ErrorObserver
     */
    private function observeExceptions()
    {
        ErrorHandler::handleExceptions(
            function (ErrorContext $context)
            {
                $this->handleCallbacks($context);

                return $this->handleErrorResponse($context);
            }
        );

        return $this;
    }
}