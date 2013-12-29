<?php
namespace MediaManager\Meta;

abstract class AccessObject {
    abstract public function getInfo();

    abstract public function putInfo(Info $info);
}