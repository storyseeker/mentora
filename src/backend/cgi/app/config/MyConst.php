<?php

class MyConst
{
    const VIEW_STATUS                   = 'partials/status';

    const COOKIE_TOKEN                  = 'ck_token';
    const COOKIE_UUID                   = 'ck_uuid';
    const COOKIE_UID                    = 'ck_uid';
    const COOKIE_TS                     = 'ck_ts';
    const COOKIE_EXPIRE                 = 2592000; // 86400 * 30
    const COOKIE_NEVER_EXPIRE           = 31536000; // 86400 * 365

    const FIELD_STATUS                  = 'status';
    const FIELD_USER                    = 'user';
    const FIELD_MESSAGE                 = 'message';
    const FIELD_NAME                    = 'name';
    const FIELD_PHONE                   = 'phone';
    const FIELD_EMAIL                   = 'email';
    const FIELD_COMPANY                 = 'company';
    const FIELD_JOB                     = 'job';
    const FIELD_OPEN                    = 'open';
    const FIELD_WEIBO                   = 'weibo';
    const FIELD_WEIXIN                  = 'weixin';
    const FIELD_LINKEDIN                = 'linkedin';
    const FIELD_GITHUB                  = 'github';
    const FIELD_PASSWORD                = 'password';
    const FIELD_PIC                     = 'pic';
    const FIELD_SELF                    = 'isSelf';

    const PARAM_USER_ACCOUNT            = 'account';
    const PARAM_USER_PASSWORD           = 'password';

    const STATUS_OK                     = 0;
    const STATUS_ERROR                  = 1;
    const STATUS_INVALID_PARAM          = 2;
    const STATUS_INVALID_USER           = 3;
    const STATUS_INVALID_PASSWORD       = 4;
    const STATUS_INVALID_EMAIL          = 5;
    const STATUS_INVALID_PHONE          = 6;
    const STATUS_EMAIL_EXISTS           = 7;
    const STATUS_PHONE_EXISTS           = 8;
    const STATUS_NOT_LOGIN              = 9;

    const SIGN_SECRET                   = "e150b2bb49de3395d8b2146856482f4f";
}
