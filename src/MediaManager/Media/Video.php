<?php
namespace MediaManager\Media;

class Video extends Media {
    const TYPE = 'video';

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
        return '{}';
    }
}