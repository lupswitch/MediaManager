<?php
namespace MediaManager\Response;

use MediaManager\Misc\HTTPStatus;

class OkResponse extends HTTPResponse {
    public function __construct($data) {
        parent::__construct(HTTPStatus::OK_CODE, $data);
    }
}