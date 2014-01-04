<?php
namespace MediaManager\View;

use MediaManager\Media\Audio;
use MediaManager\Media\Image;
use MediaManager\Media\Media;
use MediaManager\Media\Video;
use MediaManager\Misc\Config;

class Generator {
    private $config;
    public function __construct(Config $config) {
        $this->config = $config;
    }

    private function generateVideoView(Media $media) {

    }

    private function generateImageView(Media $media) {
        $viewDimensions = $this->config->get('view', [$media->getConfigSection(),'dimensions']);
        $view = imagecreatetruecolor($viewDimensions['width'], $viewDimensions['height']);
        $mediaResource = imagecreatefromstring(file_get_contents($media->getTempLocation()));
        $mediaDimensions = $media->getDimensions();
        imagecopyresized(
            $view, $mediaResource, 0, 0, 0, 0, $viewDimensions['width'],$viewDimensions['height'], $mediaDimensions['w'],
            $mediaDimensions['h']
        );
        return $view;
    }

    private function generateAudioView() {
        return [];
    }

    public function generateView(Media $media) {
        if ($media->getType() == Image::TYPE) {
            $view = $this->generateImageView($media);
        } else if ($media->getType() == Audio::TYPE){
            $view = $this->generateAudioView($media);
        } else if ($media->getType() == Video::TYPE) {
            $view = $this->generateVideoView($media);
        }

        return $view;
    }
}