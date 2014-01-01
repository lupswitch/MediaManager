<?php
namespace MediaManager\Meta;

use MediaManager\Media\Media;

abstract class AccessObject {
    abstract public function getInfo($hash);

    abstract public function putInfo(Media $media);
}