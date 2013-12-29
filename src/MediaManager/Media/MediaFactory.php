<?php
namespace MediaManager\Media;

use MediaManager\Media\Image;

class MediaFactory {
    const IMAGE = 'image';
    const AUDIO = 'audio';
    const VIDEO = 'video';

    public static function get($initData) {
        return new Image($initData);
    }
}