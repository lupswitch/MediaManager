<?php
namespace MediaManager\Media;

use MediaManager\Exceptions\NoContentException;
use MediaManager\Misc\Factory;
use MediaManager\Exceptions\BadRequestException;
use MediaManager\Storage\StorageFactory;

class MediaManager {
    private $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function getMeta($hash) {
        if($metaInfo = Factory::getInstance()->getMetaAccessObject()->getInfo($hash)) {
            return $metaInfo->toArray();
        } else {
            throw new NoContentException();
        }
    }

    public function getMedia($hash) {
        if($metaInfo = Factory::getInstance()->getMetaAccessObject()->getInfo($hash)) {
            $storage = Factory::getInstance()->getStorage();
            $mediaEncoded = $storage->getMedia($hash);
            return $mediaEncoded;
        } else {
            throw new NoContentException();
        }
    }

    public function getPreview($hash) {
        if($metaInfo = Factory::getInstance()->getMetaAccessObject()->getInfo($hash)) {
            $storage = Factory::getInstance()->getStorage();
            $viewEncoded = $storage->getView($hash);
            return $viewEncoded;
        } else {
            throw new NoContentException();
        }
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
            $storage = Factory::getInstance()->getStorage();
            $metaAccessObject = Factory::getInstance()->getMetaAccessObject();
            if ($metaAccessObject->getInfo($media->getHash())) {
                throw new BadRequestException('Media already exists');
            }
            $viewGenerator = Factory::getInstance()->getViewGenerator();
            $storage->persist($media);
            $view = $viewGenerator->generateView($media);
            $storage->persistView($view, $media);
            $metaInfo = $metaAccessObject->putInfo($media);
        } else {
            throw new BadRequestException('Invalid Request');
        }
        return $metaInfo->toArray();
    }
}