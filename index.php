<?php
include_once(__DIR__ . '/vendor/autoload.php');
define('PROJECT_BASE_DIR',__DIR__);

$mediaFactory = MediaManager\Misc\Factory::getInstance();
//TODO:Move this code elsewhere
$request = $_REQUEST;
$mediaManagerAPI = new MediaManager\API\RestAPI($request);

try {
    if ($_FILES['error']) {
        throw new \MediaManager\Exceptions\BadRequestException('File upload error');
    }
    $mediaManagerAPI->post($_FILES['file']);
} catch (\MediaManager\Exceptions\MediaManagerException $e) {
    echo 'Uncaught Exception OOPS' . $e->getMessage(); die;
   MediaManager\Exception\Handler::getExceptionResponse($e);
}

