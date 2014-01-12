<?php
namespace MediaManager\Exceptions;

use MediaManager\Misc\HTTPStatus;

class UnAuthorizedException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg, HTTPStatus::UNAUTHORIZED_CODE);
}