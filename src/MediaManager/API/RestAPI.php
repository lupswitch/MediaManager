<?php
namespace MediaManager\API;

use MediaManager\Exceptions\BadRequestException;
use MediaManager\Exceptions\UnAuthorizedException;
use MediaManager\Misc\Authentication;
use MediaManager\Misc\Factory;
use MediaManager\Media\MediaFactory;
use MediaManager\Response\JsonResponse;
use MediaManager\Response\OkResponse;

class RestAPI {
    private function okResponse($responseData = '') {
        header('HTTP/1.1 200 OK');
        if ($responseData) {
            header('Content-type: application/json');
            echo $responseData;
        }
    }

    public function getMeta($hash) {
        if (! $hash) {
            throw new BadRequestException('Missing Required parameters');
        }
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManager();
            $metaInfo = $mediaManager->getMeta($hash);
            return new JsonResponse($metaInfo);
        } else {
            throw new UnAuthorizedException('User unauthorized!');
        }
    }

    public function getMedia($hash) {
        if (! $hash) {
            throw new BadRequestException('Missing Required parameters');
        }
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManager();
            $media = $mediaManager->getMedia($hash);
            return new OkResponse($media);
        } else {
            throw new UnAuthorizedException('User unauthorized!');
        }
    }

    public function getPreview($hash) {
        if (! $hash) {
            throw new BadRequestException('Missing Required parameters');
        }
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManager();
            $preview = $mediaManager->getPreview($hash);
            return new OkResponse($preview);
        } else {
            throw new UnAuthorizedException('User unauthorized');
        }
    }

    public function post($file) {
        if (Authentication::getInstance()->isAuthenticated()) {
            $mediaManager = Factory::getInstance()->getMediaManager();
            $metaInfo = $mediaManager->post($file);
            return new JsonResponse($metaInfo);
        } else {
            throw new UnAuthorizedException('User unauthorized!');
        }

    }
}
