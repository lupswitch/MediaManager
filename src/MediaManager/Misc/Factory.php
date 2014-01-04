<?php
namespace MediaManager\Misc;

use FFMpeg\FFMpeg;
use MediaManager\Exceptions\BadRequestException;
use MediaManager\Media\Audio;
use MediaManager\Media\Image;
use MediaManager\Media\MediaManager;
use MediaManager\Media\Video;
use MediaManager\Meta\DBAccessObject;
use MediaManager\Meta\Info;
use MediaManager\Storage\FileStorage;
use MediaManager\View\Generator;

class Factory {
    private static $instance;
    private $configPath;
    private $config;
    const IMAGE = 'image';
    const AUDIO = 'audio';
    const VIDEO = 'video';

    private function __construct() {
        $this->configPath = PROJECT_BASE_DIR . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR,['config','config.yml']);
        $this->config = Config::getInstance($this->configPath);
    }

    public static function getInstance() {
        if (! self::$instance) {
            $className = __CLASS__;
            self::$instance = new $className();
        }
        return self::$instance;
    }

    public function getConfig() {
        return $this->config;
    }

    private function getDbConnection() {
        $dbParams = $this->config->get('db');
        return new \PDO('mysql:host=' . $dbParams['host'] . ';dbname=' . $dbParams['dbname'], $dbParams['user'], $dbParams['pwd']);
    }

    public  function getMetaAccessObject() {
        //TODO: Add more options later
        //$accessObjectType = $this->config->get('meta','access_type') ? : 'db';
        return new DBAccessObject($this->getDbConnection());
    }

    public function getMediaManager() {
        return new MediaManager($this->getConfig());
    }

    public function getMedia($initData) {
        $mediaType = explode('/', $initData['type'])[0];
        if ($mediaType == self::IMAGE) {
            $media = new Image($initData);
        } else if ($mediaType == self::AUDIO) {
            $media =  new Audio($initData);
        } else if ($mediaType == self::VIDEO) {
            $media = new Video($initData);
        } else {
            throw new BadRequestException('Invalid media type');
        }
        return $media;
    }

    public function getMetaInfo() {
        return new Info();
    }

    /*@return FileStorage */
    public function getStorage() {
        return new FileStorage($this->getConfig());
    }

    /*@return FFMPeg*/
    public function getFFMpegInstance() {
        return FFMpeg::create();
    }

    /*@return Generator*/
    public function getViewGenerator() {
        return new Generator($this->getConfig());
    }
}