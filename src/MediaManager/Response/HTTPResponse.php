<?php
namespace MediaManager\Response;

use MediaManager\Misc\HTTPStatus;

abstract class HTTPResponse extends Response {
    private  $statusCode;
    private  $responseContent;
    private  $statusText;
    private  $headers = [];

    protected function __construct($statusCode, $content = null) {
        $this->statusCode = $statusCode;
        $this->statusText = HTTPStatus::$map[$this->statusCode];
        $this->responseContent = $content;
    }

    public function addHeader($header) {
        if (! headers_sent()) {
            array_push($this->headers, $header);
        }
    }

    public function respond() {
        header('HTTP/1.1 ' . $this->statusCode . ' ' . $this->statusText);
        foreach ($this->headers as $header) {
            header($header);
        }
        if ($this->responseContent) {
            echo $this->responseContent;
        }
    }
}