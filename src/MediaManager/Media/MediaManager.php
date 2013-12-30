<?php
namespace MediaManager\Media;

use MediaManager\Misc\Factory;
use MediaManager\Exceptions\BadRequestException;
use MediaManager\Storage\StorageFactory;

class MediaManager {
    private $config;

    public function __construct($config) {
        $this->config = $config;
    }

    private function isValidMedia(Media $media) {
        $invalidName = ['.', '..'];
        $validMimeType = $this->config->get('media', [$media->getConfigSection(), 'mime']);
        $validExtension = $this->config->get('media', [$media->getConfigSection(), 'extn']);
        $validMaxSize = $this->config->get('media', [$media->getConfigSection(), 'size']);

        if(in_array($media->getName(), $invalidName)) {
            throw new BadRequestException('Invalid Request');
        }
        if(! in_array($media->getExtension(), $validExtension)) {
            throw new BadRequestException('Extension ' . $media->getExtension() . ' not allowed RTFM');
        }
        if($media->getSize() > $validMaxSize) {
            throw new BadRequestException('File size exceeded');
        }
        if(! in_array($media->getMime(), $validMimeType)) {
            throw new BadRequestException('Mime ' . $media->getMime() . ' not allowed');
        }

        return true;
    }

    public function post($file) {
        $media = Factory::getInstance()->getMedia($file);
        if ($this->isValidMedia($media)) {
            $storage = StorageFactory::get(StorageFactory::FILE, null);
            $storage->persist($media);
            $metaAccessObject = Factory::getInstance()->getMetaAccessObject();
            $metaInfo = $metaAccessObject->putInfo($media);
        } else {
            throw new BadRequestException('Invalid Request');
        }
        return $metaInfo->toArray();
    }
}