<?php
namespace MediaManager\Media;

class Image extends Media {
    const TYPE = 'image';

    public function __construct($file) {
        parent::__construct($file);
    }

    public function getConfigSection() {
        return self::TYPE;
    }

    public function getType() {
        return self::TYPE;
    }

    public function getDimensions() {
        $dimensions = getimagesize($this->getTempLocation());
        return json_encode(['w'=> $dimensions[0], 'h' => $dimensions[1]]);
    }
}