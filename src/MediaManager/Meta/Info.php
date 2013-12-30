<?php
namespace MediaManager\Meta;

class Info {
    private $name;
    private $type;

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

    public function toArray() {
        return ['name' => $this->getName(), 'type' => $this->getType()];
    }
}