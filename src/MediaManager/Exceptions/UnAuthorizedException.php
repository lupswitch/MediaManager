<?php
namespace MediaManager\Exceptions;

class UnAuthorizedException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg,401);
    }
}