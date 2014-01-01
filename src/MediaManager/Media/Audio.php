<?php
namespace MediaManager\Media;

class Audio extends Media {
    const TYPE = 'audio';

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