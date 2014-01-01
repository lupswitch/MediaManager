<?php
namespace MediaManager\Media;

use MediaManager\Misc\Authentication;

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
        return urlencode($this->name);
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
        $userId = Authentication::getInstance()->getUserId();
        return md5($userId . md5_file($this->getTempLocation()));
    }

    abstract public function getDimensions();
}