<?php
namespace MediaManager\API;

use MediaManager\Media\MediaFactory;
use MediaManager\Media\MediaManager;

class RestAPI {
    private $request;

    public function __construct($request) {
        $this->request = $request;
    }

    private function getMediaManager() {
        //TODO:Inject a few dependencies here later
        return new MediaManager();
    }

    private function okResponse($responseData = '') {
        header('HTTP/1.1 200 OK');
        if ($responseData) {
            header('Content-type: application/json');
            echo $responseData;
        }
    }

    public function post($file) {
        $mediaManager = $this->getMediaManager();
        $metaInfo = $mediaManager->post($file);

        return $this->okResponse(json_encode($metaInfo));
    }
}