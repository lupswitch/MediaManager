<?php

namespace MediaManager\Misc;

class HTTPStatus {
    const OK_CODE = 200;
    const NORESPONSE_CODE = 204;
    const BADREQUEST_CODE = 400;
    const UNAUTHORIZED_CODE = 401;
    const PAGENOTFOUND_CODE = 404;
    const SERVERERROR_CODE = 500;

    const OK_TEXT = 'OK';
    const NORESPONSE_TEXT = 'No Content';
    const BADREQUEST_TEXT = 'Bad Request';
    const UNAUTHORIZED_TEXT = 'UnAuthorized';
    const PAGENOTFOUND_TEXT = 'Page Not Found';
    const SERVERERROR_TEXT = 'Internal Server Error';

    public static $map = [
        self::OK_CODE => self::OK_TEXT,
        self::NORESPONSE_CODE => self::NORESPONSE_TEXT,
        self::BADREQUEST_CODE => self::BADREQUEST_TEXT,
        self::UNAUTHORIZED_CODE => self::UNAUTHORIZED_TEXT,
        self::PAGENOTFOUND_CODE => self::PAGENOTFOUND_TEXT,
        self::SERVERERROR_CODE => self::SERVERERROR_TEXT
    ];
}