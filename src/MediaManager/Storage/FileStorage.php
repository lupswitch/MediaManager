<?php
namespace MediaManager\Storage\FileStorage;

use MediaManager\Media\Media\Media;
use MediaManager\Storage\Storage\Storage;

class FileStorage extends Storage {
    public function persist(Media $media) {
        return true;
    }
}