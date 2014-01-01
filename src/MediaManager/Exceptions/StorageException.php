<?php
namespace MediaManager\Exceptions;

class StorageException extends MediaManagerException {
    public function __construct($msg) {
        parent::__construct($msg,500);
    }
}