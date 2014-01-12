<?php
namespace MediaManager\Response;

use MediaManager\Misc\HTTPStatus;

abstract class HTTPResponse extends Response {
    private  $statusCode;
    private  $responseContent;
    private  $statusText;

    protected function __construct($statusCode, $content = '') {
        $this->statusCode = $statusCode;
        $this->statusText = HTTPStatus::$map[$this->statusCode];
        $this->responseContent = $content;
    }

    public function respond() {
        header('HTTP/1.1 ' . $this->statusCode . ' ' . $this->statusText);
        if ($this->responseContent) {
            echo $this->responseContent;
        }
    }
}