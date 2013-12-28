<?php
namespace MediaManager\API\RestAPI;

use MediaManager\Media\MediaFactory\MediaFactory;
use MediaManager\Meta\Info\Info;

class RestAPI {
    private $request;

    public function __construct($request) {
        $this->metaInfo = new Info();
        $this->request = $request;
    }

    public function post($file) {
        $media = MediaFactory::getMedia(MediaFactory::IMAGE, null);
        $storage = StorageFactory::getStorage(StorageFactory::FILE, null);
        $storage->persist($media);
        $this->metaInfo->persist($media);
        return $this->okResponse();
    }
}