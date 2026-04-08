<?php

class SJB_Error extends \Monolog\Logger
{
    /**
     * @var \Monolog\Logger
     */
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        }

        register_shutdown_function(['SJB_Error', 'fatalErrorHandler']);
        set_exception_handler(['SJB_Error', 'fatalErrorHandler']);

        self::$instance = new SJB_Error('logger');

        if (SJB_System::getSystemSettings('sentry')) {
            $client = new Raven_Client(SJB_System::getSystemSettings('sentry'));
            self::$instance->pushHandler(new \Monolog\Handler\RavenHandler($client));
        }
        self::$instance->pushHandler(new \Monolog\Handler\ErrorLogHandler());
        $handler = new \Monolog\ErrorHandler(self::$instance);
        $handler->registerErrorHandler();
        $handler->registerExceptionHandler();
        $handler->registerFatalHandler();
        return self::$instance;
    }

    public static function fatalErrorHandler()
    {
        $lastError = error_get_last();
        $args = func_get_args();
        $message = '';
        if ($args && $args[0] instanceof Exception) {
            self::getInstance()->addError($args[0]->getMessage(), [
                'exception' => $args[0]
            ]);
            $message = $args[0]->getMessage();
        }

        if (in_array($lastError['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
            self::getInstance()->addError($lastError['message'], [
                'file' => $lastError['file'],
                'line' => $lastError['line']
            ]);
            $message = $lastError['message'];
        }
        if ($message) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 503 Service Unavailable');
            ?>
                <html>
                    <head>
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    </head>
                    <body>
                        <div class="container">
                            <br>
                            <div class="alert alert-danger">Oops... Something went wrong. Please try again!</div>
                        </div>
                    </body>
                </html>
            <?php
        }
    }
}
