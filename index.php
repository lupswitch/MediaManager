<?php
include_once(__DIR__ . '/vendor/autoload.php');
define('PROJECT_BASE_DIR',__DIR__);

$mediaFactory = MediaManager\Misc\Factory::getInstance();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request = $_POST;
} else if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $request = $_GET;
}

$mediaManagerAPI = new MediaManager\API\RestAPI();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_FILES['file']['error']) {
            throw new \MediaManager\Exceptions\BadRequestException('File upload error');
        }
        $response = $mediaManagerAPI->post($_FILES['file']);
    } else if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $hash = $request['hash'];
        $response = $mediaManagerAPI->get($hash);
    }
} catch (\MediaManager\Exceptions\MediaManagerException $e) {
    $response = new \MediaManager\Response\ExceptionResponse($e);
}
$response->respond();
