<?php
namespace MediaManager\Storage;

use MediaManager\Storage\FileStorage;

class StorageFactory {
    const FILE = 'file';
    public static function get($type, $initData) {
        return new FileStorage($initData);
    }
}