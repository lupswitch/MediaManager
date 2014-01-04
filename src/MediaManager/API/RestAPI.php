<?php
namespace MediaManager\API;

use MediaManager\Exceptions\BadRequestException;
use MediaManager\Exceptions\UnAuthorizedException;
use MediaManager\Misc\Authentication;
use MediaManager\Misc\Factory;
use MediaManager\Media\MediaFactory;

class RestAPI {
    private function okResponse($responseData = '') {
        header('HTTP/1.1 200 OK');
        if ($responseData) {
            header('Content-type: application/json');
            echo $responseData;
        }
    }

    public function get($hash) {
        if (! $hash) {
            throw new BadRequestException('Missing Required parameters');
        }
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManager();
            $metaInfo = $mediaManager->get($hash);
            return $this->okResponse(json_encode($metaInfo));
        } else {
            throw new UnAuthorizedException('User unauthorized!');
        }
    }

    public function getPreview($hash) {
        if (! $hash) {
            throw new BadRequestException('Missing Required parameters');
        }
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManagaer();
            $preview = $mediaManager->getPreview($hash);
            return $this->okResponse($preview);
        } else {
            throw new UnAuthorizedException('User unauthorized');
        }
    }

    public function post($file) {
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManager();
            $metaInfo = $mediaManager->post($file);
            return $this->okResponse(json_encode($metaInfo));
        } else {
            throw new UnAuthorizedException('User unauthorized!');
        }

    }
}