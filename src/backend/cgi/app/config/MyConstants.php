<?php

class MyConst
{
    const COOKIE_TOKEN                  = 'ck_token';
    const COOKIE_UID                    = 'ck_uid';
    const COOKIE_EXPIRE                 = 2592000; // 86400 * 30

    const FIELD_STATUS                  = 'status';
    const FIELD_USER                    = 'user';
    const FIELD_MESSAGE                 = 'message';
    const FIELD_PHONE                   = 'phone';
    const FIELD_EMAIL                   = 'email';

    const PARAM_USER_ACCOUNT            = 'account';
    const PARAM_USER_PASSWORD           = 'password';

    const STATUS_OK                     = 0;
    const STATUS_ERROR                  = 1;
    const STATUS_INVALID_PARAM          = 2;
    const STATUS_INVALID_USER           = 3;
    const STATUS_INVALID_PASSWORD       = 4;
}
