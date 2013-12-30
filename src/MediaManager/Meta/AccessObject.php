<?php
namespace MediaManager\Meta;

use MediaManager\Media\Media;

abstract class AccessObject {
    abstract public function getInfo();

    abstract public function putInfo(Media $media);
}