<?php
namespace MediaManager\Meta;

class DBAccessObject extends AccessObject {
    protected $dbConn;

    public function __construct($dbConn) {
        $this->dbConn = $dbConn;
    }

    public function getInfo() {

    }

    public function putInfo(Info $info) {

    }
}