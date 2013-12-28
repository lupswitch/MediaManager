<?php
namespace MediaManager\Storage\StorageFactory;

use MediaManager\Storage\FileStorage\FileStorage;

class StorageFactory {
    const FILE = 'file';
    public static function get($type, $initData) {
        return new FileStorage($initData);
    }
}