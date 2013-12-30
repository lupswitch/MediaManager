<?php
namespace MediaManager\Meta;

use MediaManager\Media\Media;
use MediaManager\Misc\Factory;

class DBAccessObject extends AccessObject {
    protected $dbConn;

    public function __construct($dbConn) {
        $this->dbConn = $dbConn;
    }

    public function getInfo() {
    }

    private function getInfoFromMedia(Media $media) {
        $info = Factory::getInstance()->getMetaInfo();
        $info->setName($media->getName())->setType($media->getType());
        //$info->setDimensions($media->setDimensions());
        //$info->setOwner();
        return $info;
    }

    public function putInfo(Media $media) {
        $info = $this->getInfoFromMedia($media);
        $query = 'INSERT INTO meta(name, type) VALUES(:name, :type)';
        $stmt = $this->dbConn->prepare($query);
        $stmt->bindValue(':name',$info->getName());
        $stmt->bindValue(':type',$info->getType());
        $stmt->execute();

        return $info;
    }
}