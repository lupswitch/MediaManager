<?php
namespace MediaManager\Response;

use MediaManager\Exceptions\MediaManagerException;
use MediaManager\Misc\HTTPStatus;

class ExceptionResponse extends HTTPResponse {

    public function __construct(\Exception $e) {
        if ($e instanceof MediaManagerException) {
            $statusCode = $e->getCode();
            $response = $e->getMessage();
        } else {
            $statusCode = HTTPStatus::SERVERERROR_CODE;
            $response = '';
        }
        parent::__construct($statusCode, $response);
    }
}