<?php
namespace MediaManager\Exceptions;

class MediaManagerException extends \Exception {
    public function __construct($msg, $code=0) {
        parent::__construct($msg,$code);
    }
}