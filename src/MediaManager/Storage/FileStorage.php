<?php
namespace MediaManager\Storage;

use MediaManager\Media\Media;

class FileStorage extends Storage {
    private $location;
    public function __construct($location='') {
        $this->location = '/var/www/kabadi';
    }

    private function getAbsStorageLocation($hash) {
        //TODO
        return $this->location . DIRECTORY_SEPARATOR . $hash;
    }

    public function persist(Media $media) {
        //TODO:Check if location does not exist and create it then
        $persistLocation = $this->getAbsStorageLocation($media->getHash());
        return move_uploaded_file($media->getTempLocation(), $persistLocation);
    }
}