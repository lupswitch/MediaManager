<?php
namespace MediaManager\Media;

abstract class Media {
    protected $file;
    public function __construct($file) {
        $this->file = $file;
    }

    public function getTempLocation() {
        return $this->file['tmp_name'];
    }

    public function getHash() {
        //TODO:
        return $this->file['name'];
    }
}