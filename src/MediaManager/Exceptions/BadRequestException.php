<?php
namespace MediaManager\Exceptions;

class BadRequestException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg,400);
    }
}