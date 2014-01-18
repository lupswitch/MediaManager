<?php
namespace MediaManager\Storage;

use MediaManager\Exceptions\NoContentException;
use MediaManager\Exceptions\StorageException;
use MediaManager\Media\Media;
use MediaManager\Misc\Config;

class FileStorage extends Storage {
    private $config;
    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function getTempStorageLocation() {
        $location = $this->config->get('storage',['file','tmp_location']);
        if (! (is_dir($location) && is_writable($location))) {
            throw new StorageException('Storage not Accessible');
        }
        return $location;
    }

    private function getStorageLocation() {
        $location = $this->config->get('storage',['file','location']);
        if (! (is_dir($location) && is_writable($location))) {
            throw new StorageException('Storage not Accessible');
        }
        return $location;
    }

    private function getAbsStorageLocation($hash) {
        $location = $this->getStorageLocation();
        return $location . DIRECTORY_SEPARATOR . $hash;
    }

    public function getMedia($hash) {
        //TODO:Refine name generation later
        $prefix = '';
        $location = $this->config->get('storage',['file','location']);
        $mediaPath = $location . DIRECTORY_SEPARATOR . $prefix . $hash;
        if (file_exists($mediaPath)) {
            $media = base64_encode(file_get_contents($mediaPath));
        } else {
            throw new NoContentException();
        }
        return $media;
    }

    public function getView($hash) {
        //TODO:Refine name generation later
        $prefix = '_';
        $location = $this->config->get('storage',['file','location']);
        $viewPath = $location . DIRECTORY_SEPARATOR . $prefix . $hash;
        if (file_exists($viewPath)) {
            $view = base64_encode(file_get_contents($viewPath));
        } else {
            throw new NoContentException();
        }
        return $view;
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
