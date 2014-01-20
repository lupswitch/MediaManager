<?php
include_once(__DIR__ . '/vendor/autoload.php');
define('PROJECT_BASE_DIR',__DIR__);

$apiClassName = 'MediaManager\API\RestAPI';
$mux = new \Pux\Mux();
$mux->get('/meta/:hash', [$apiClassName, 'getMeta']);
$mux->get('/media/:hash', [$apiClassName, 'getMedia']);
$mux->get('/preview/:hash', [$apiClassName, 'getPreview']);
$mux->post('/media', [$apiClassName,  'post'], ['vars' => ['file' => $_FILES['file']]]);

try {
    $route = $mux->dispatch($_SERVER['PATH_INFO']);
    $response = \Pux\Executor::execute($route);
} catch (\MediaManager\Exceptions\MediaManagerException $e) {
    $response = new \MediaManager\Response\ExceptionResponse($e);
}
$response->respond();
