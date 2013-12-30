<?php
namespace MediaManager\Media;

abstract class Media {
    protected $name;
    protected $tempName;
    protected $size;
    protected $mime;

    protected function __construct($file) {
        $this->name = $file['name'];
        $this->tempName = $file['tmp_name'];
        $this->size = $file['size'];
        $this->mime = $file['type'];
    }

    public function getName() {
        return $this->name;
    }

    public function getExtension() {
        $nameArr = explode('.', $this->getName());
        return end($nameArr);
    }

    public function getTempLocation() {
        return $this->tempName;
    }

    public function getMime() {
        return $this->mime;
    }

    public function getSize() {
        return $this->size;
    }

    public function getHash() {
        //TODO:
        return $this->name;
    }

    //abstract public function getDimensions();
}