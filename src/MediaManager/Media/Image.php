<?php
namespace MediaManager\Media;

use MediaManager\Media\Media;

class Image extends Media {
    public function __construct($file) {
        parent::__construct($file);
    }
}