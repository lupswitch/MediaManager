<?php
namespace MediaManager\Meta;

class Info {
    private $name;
    private $type;
    private $dimensions;
    private $hash;
    private $userId;

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setDimensions($dimensions) {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function getDimensions() {
        return $this->dimensions;
    }

    public function setHash($hash) {
        $this->hash = $hash;
        return $this;
    }

    public function getHash() {
        return $this->hash;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function getUserId() {
        return $this->userId;
    }


    public function toArray() {
        return [
            'name' => $this->getName(), 'type' => $this->getType(), 'dimensions'=> $this->getDimensions(),
            'hash' => $this->getHash()
        ];
    }
}