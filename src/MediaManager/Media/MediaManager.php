<?php
namespace MediaManager\Media;

use MediaManager\Meta\Info;
use MediaManager\Storage\StorageFactory;

class MediaManager {
    public function __construct() {
        $this->metaInfo = new Info();
    }

    /**TODO**/
    private function isValidMediaRequest($file) {
        return true;
    }

    public function post($file) {
        if ($this->isValidMediaRequest($file)) {
            $media = MediaFactory::get(MediaFactory::IMAGE, $file);
            $storage = StorageFactory::get(StorageFactory::FILE, null);
            $storage->persist($media);
            //$metaInfo = $this->metaInfo->persist($media);
            return true;
        } else {
            throw new BadRequestException('Invalid Request');
        }
        return $metaInfo;
    }
}