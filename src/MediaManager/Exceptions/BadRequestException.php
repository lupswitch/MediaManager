<?php
namespace MediaManager\Exceptions;

use MediaManager\Misc\HTTPStatus;

class BadRequestException extends MediaManagerException {
    public function __construct($msg='') {
        parent::__construct($msg, HTTPStatus::BADREQUEST_CODE);
    }
}