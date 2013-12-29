<?php
namespace MediaManager\Misc;

use Symfony\Component\Yaml\Yaml;

class Config {
    private static $instance;
    private $config;
    private function __construct($configPath) {
        $this->config = Yaml::parse(file_get_contents($configPath));
    }

    public static function getInstance($configPath) {
        if (! self::$instance) {
            $className = __CLASS__;
            self::$instance = new $className($configPath);
        }
        return self::$instance;
    }

    public function get($section, array $subsection = []) {
        $value = null;
        if (isset($this->config[$section])) {
            $arr = $this->config[$section];
            foreach($subsection as $sub) {
                if (! isset($arr[$sub])) {
                    break;
                } else {
                    $arr = $arr[$sub];
                }
            }
            $value = $arr;
        }
        return $value;
    }
}