<?php
namespace MediaManager\Exceptions;

use MediaManager\Misc\HTTPStatus;

class NoContentException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg, HTTPStatus::NORESPONSE_CODE);
    }
}