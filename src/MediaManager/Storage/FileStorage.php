<?php
namespace MediaManager\Storage;

use MediaManager\Exceptions\StorageException;
use MediaManager\Media\Media;
use MediaManager\Misc\Config;

class FileStorage extends Storage {
    private $config;
    public function __construct(Config $config) {
        $this->config = $config;
    }

    private function getAbsStorageLocation($hash) {
        $location = $this->config->get('storage',['file','location']);
        if (! (is_dir($location) && is_writable($location))) {
            throw new StorageException('Storage not Accessible');
        }

        return $location . DIRECTORY_SEPARATOR . $hash;
    }

    public function persist(Media $media) {
        $persistLocation = $this->getAbsStorageLocation($media->getHash());
        return copy($media->getTempLocation(), $persistLocation);
    }

    public function persistView($view,Media $media) {
        $status  = false;
        $persistLocation = $this->getAbsStorageLocation('_' . $media->getHash());
        if (is_resource($view) && get_resource_type($view) == 'gd') {
            $status = imagejpeg($view, $persistLocation);
            imagedestroy($view);
        }
        return $status;
    }
}
