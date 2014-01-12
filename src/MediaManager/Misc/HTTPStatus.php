<?php

namespace MediaManager\Misc;

class HTTPStatus {
    CONST OK_CODE = 200;
    CONST NORESPONSE_CODE = 204;
    CONST BADREQUEST_CODE = 400;
    CONST PAGENOTFOUND_CODE = 404;
    CONST SERVERERROR_CODE = 500;

    CONST OK_TEXT = 'OK';
    CONST NORESPONSE_TEXT = 'No Content';
    CONST BADREQUEST_TEXT = 'Bad Request';
    CONST PAGENOTFOUND_TEXT = 'Page Not Found';
    CONST SERVERERROR_TEXT = 'Internal Server Error';

    public static $map = [
        self::OK_CODE => self::OK_TEXT,
        self::NORESPONSE_CODE => self::NORESPONSE_TEXT,
        self::BADREQUEST_CODE => self::BADREQUEST_TEXT,
        self::PAGENOTFOUND_CODE => self::PAGENOTFOUND_TEXT,
        self::SERVERERROR_CODE => self::SERVERERROR_TEXT
    ];
}