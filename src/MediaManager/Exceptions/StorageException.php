<?php
namespace MediaManager\Exceptions;

use MediaManager\Misc\HTTPStatus;

class StorageException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg, HTTPStatus::SERVERERROR_CODE);
    }
}