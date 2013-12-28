<?php
namespace MediaManager\Storage;

use MediaManager\Media\Media;

abstract class Storage {
    abstract public function persist(Media $media);
}