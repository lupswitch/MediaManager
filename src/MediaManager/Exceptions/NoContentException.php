<?php
namespace MediaManager\Exceptions;

class NoContentException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg, 204);
    }
}