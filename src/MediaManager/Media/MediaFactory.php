<?php
namespace MediaManager\Media\MediaFactory;

use MediaManager\Media\Image\Image;

class MediaFactory {
    const IMAGE = 'image';
    const AUDIO = 'audio';
    const VIDEO = 'video';

    public static function getMedia($type, $initData) {
        return new Image($initData);
    }
}