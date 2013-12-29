<?php
namespace MediaManager\Misc;

use MediaManager\Media\MediaManager;
use MediaManager\Meta\DBAccessObject;

class Factory {
    private static $instance;
    private $configPath;
    private $config;

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

    private function getMetaAccessObject() {
        //TODO: Add more options later
        //$accessObjectType = $this->config->get('meta','access_type') ? : 'db';
        return new DBAccessObject($this->getDbConnection());
    }

    public function getMediaManager() {
        return new MediaManager($this->getConfig(), $this->getMetaAccessObject());
    }
}