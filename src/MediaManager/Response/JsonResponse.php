<?php
namespace MediaManager\Response;

use MediaManager\Misc\HTTPStatus;

class JsonResponse extends HTTPResponse {
    public function __construct($data) {
        parent::__construct(HTTPStatus::OK_CODE, json_encode($data));
    }
}