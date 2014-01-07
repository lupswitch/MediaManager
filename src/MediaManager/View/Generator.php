<?php
namespace MediaManager\View;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use MediaManager\Media\Audio;
use MediaManager\Media\Image;
use MediaManager\Media\Media;
use MediaManager\Media\Video;
use MediaManager\Misc\Config;
use MediaManager\Misc\Factory;

class Generator {
    private $config;
    public function __construct(Config $config) {
        $this->config = $config;
    }

    private function generateVideoView(Media $media) {
        $ffmpeg = Factory::getInstance()->getFFMpegInstance();
        $video = $ffmpeg->open($media->getTempLocation());
        $frameShot = $this->config->get('view', [$media->getConfigSection(), 'frametime']);
        $tmpLocation = Factory::getInstance()->getStorage()->getTempStorageLocation() . DIRECTORY_SEPARATOR .
                $media->getHash() . 'tmp.jpeg' ;
        $video->frame(TimeCode::fromSeconds((int)$frameShot))->save($tmpLocation, true);

        $viewDimensions = $this->config->get('view', [$media->getConfigSection(),'dimensions']);
        $view = imagecreatetruecolor($viewDimensions['width'], $viewDimensions['height']);
        $mediaResource = imagecreatefromstring(file_get_contents($tmpLocation));
        $mediaDimensions = getimagesize($tmpLocation);
        imagecopyresized(
            $view, $mediaResource, 0, 0, 0, 0, $viewDimensions['width'],$viewDimensions['height'], $mediaDimensions[0],
            $mediaDimensions[1]
        );
        unlink ($tmpLocation);
        return $view;
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

    private function generateAudioView(Media $media) {
        $viewDimensions = $this->config->get('view', [$media->getConfigSection(),'dimensions']);
        $view = imagecreate($viewDimensions['width'], $viewDimensions['height']);
        $bg = imagecolorallocate($view, 255, 255, 255);
        $textcolor = imagecolorallocate($view, 0, 0, 255);
        //TODO:Position text as per view dimensions
        imagestring($view, 1, 5, 5, substr($media->getRealName(),0,15), $textcolor);
        imagestring($view, 1, 5, 15,implode('  ',$media->getDimensions()), $textcolor);

        return $view;
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