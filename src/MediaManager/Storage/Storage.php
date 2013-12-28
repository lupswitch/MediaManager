<?php
namespace MediaManager\Storage\Storage;

use MediaManager\Media\Media\Media;

abstract class Storage {
    abstract public function persist(Media $media);
}