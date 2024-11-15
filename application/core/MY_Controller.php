<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        set_error_handler(function ($severity, $message, $file, $line) {
            throw new ErrorException($message, 0, $severity, $file, $line);
        });

        register_shutdown_function(function () {
            $error = error_get_last();
            if ($error !== null) {
                http_response_code(500);
                ob_end_clean();
                header('Content-Type: text/plain');
                echo 'A fatal error occurred. Please try again later.' . PHP_EOL;
                echo 'Error: ' . $error['message'] . PHP_EOL . 'File: ' . $error['file'] . PHP_EOL . 'Line: ' . $error['line'];
                error_log($error['message'] . ' in ' . $error['file'] . ' on line ' . $error['line']);
            }
        });
    }

    protected function handleException(Throwable $e)
    {
        http_response_code(500);
        ob_end_clean();
        header('Content-Type: text/plain');

        echo 'An error occurred: ' . $e->getMessage() . PHP_EOL;
        echo 'File: ' . $e->getFile() . PHP_EOL;
        echo 'Line: ' . $e->getLine() . PHP_EOL;
        echo 'Stack trace:' . PHP_EOL . $e->getTraceAsString();

        error_log($e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
        error_log($e->getTraceAsString());
    }
}
