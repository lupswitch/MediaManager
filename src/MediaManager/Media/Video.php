<?php
namespace MediaManager\Media;

use MediaManager\Misc\Factory;
use FFMpeg\FFMpeg;

class Video extends Media {
    const TYPE = 'video';

    public function __construct($file) {
        parent::__construct($file);
    }

    public function getConfigSection() {
        return self::TYPE;
    }

    public function getType() {
        return self::TYPE;
    }

    public function getDimensions() {
        /** @var  $ffmpeg FFMpeg*/
        $ffmpeg = Factory::getInstance()->getFFMpegInstance();
        $media = $ffmpeg->open($this->getTempLocation());
        $data = $media->getFormat()->all();
        $dimension = [
                'length'=>number_format($data['duration'], 2, '.', ','),
                'bitrate'=>number_format($data['bit_rate'], 2, '.', ',')
            ];
        return $dimension;
    }
}