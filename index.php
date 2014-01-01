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
        $mediaManagerAPI->post($_FILES['file']);
    } else if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $hash = $request['hash'];
        $mediaManagerAPI->get($hash);
    }
} catch (\MediaManager\Exceptions\MediaManagerException $e) {
    echo 'Uncaught Exception OOPS' . $e->getMessage(); die;
   MediaManager\Exception\Handler::getExceptionResponse($e);
}

