<?php
namespace MediaManager\Meta;

use MediaManager\Media\Media;
use MediaManager\Misc\Authentication;
use MediaManager\Misc\Factory;

class DBAccessObject extends AccessObject {
    protected $dbConn;

    public function __construct($dbConn) {
        $this->dbConn = $dbConn;
    }

    public function getInfo($hash) {
        $query = 'SELECT * FROM meta WHERE userId = :userId and hash =:hash';
        $stmt = $this->dbConn->prepare($query);
        $stmt->bindValue(':userId',Authentication::getInstance()->getUserId());
        $stmt->bindValue(':hash',$hash);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        $info = null;
        if ($result) {
            /** @var  $info Info*/
            $info = Factory::getInstance()->getMetaInfo();
            $info->setName($result['name'])->setType($result['type'])->setDimensions($result['dimensions'])
                ->setHash($result['hash'])->setUserId($result['userId']);
        }
        return $info;
    }

    private function getInfoFromMedia(Media $media) {
        $info = Factory::getInstance()->getMetaInfo();
        $info->setName($media->getName())->setType($media->getType())->setDimensions($media->getDimensions())
            ->setHash($media->getHash())->setUserId(Authentication::getInstance()->getUserId());
        return $info;
    }

    public function putInfo(Media $media) {
        $info = $this->getInfoFromMedia($media);
        $query = 'INSERT INTO meta(name, type,dimensions, hash, userId) VALUES(:name, :type, :dimensions, :hash, :userId)';
        $stmt = $this->dbConn->prepare($query);
        $stmt->bindValue(':name',$info->getName());
        $stmt->bindValue(':type',$info->getType());
        $stmt->bindValue(':dimensions',json_encode($info->getDimensions()));
        $stmt->bindValue(':hash',$info->getHash());
        $stmt->bindValue(':userId',$info->getUserId());
        $stmt->execute();

        return $info;
    }
}