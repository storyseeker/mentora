<?php

class MyTool
{
    public static function get($controller, $name, $defaultValue = null)
    {
        if ($controller->request->has($name))
        {
            return @trim($controller->request->get($name));
        }
        return @trim($controller->dispatcher->getParam($name, $defaultValue));
    }

    public static function setVar($controller, $name, $value)
    {
        $controller->view->setVar($name, $value);
    }

    public static function hasCookie($controller, $name)
    {
        return $controller->cookies->has($name);
    }

    public static function getCookie($controller, $name)
    {
        if ($controller->cookies->has($name))
        {
            return @trim($controller->cookies->get($name));
        }
        return null;
    }

    public static function setCookie($controller, $name, $value, $expire)
    {
        $controller->cookies->set($name, $value, time() + $expire);
    }

    public static function genUuid($seed)
    {
        return md5($seed. rand());
    }

    public static function getUuid()
    {
        if (!self::hasCookie($controller, MyConst::COOKIE_UUID)) {
            return null;
        }
        return self::getCookie($controller, MyConst::COOKIE_UUID);
    }

    public static function genToken($controller, $uid, $ts)
    {
        return md5($uid. MyConst::SIGN_SECRET. $ts);
    }

    public static function loginAuth($controller)
    {
        if (!self::hasCookie($controller, MyConst::COOKIE_TOKEN)) {
            return false;
        }
        if (!self::hasCookie($controller, MyConst::COOKIE_UID)) {
            return false;
        }
        if (!self::hasCookie($controller, MyConst::COOKIE_TS)) {
            return false;
        }
        $token = self::getCookie($controller, MyConst::COOKIE_TOKEN);
        $uid = self::getCookie($controller, MyConst::COOKIE_UID);
        $ts = self::getCookie($controller, MyConst::COOKIE_TS);
        $token2 = self::genToken($controller, $uid, $ts);
        $controller->logger->log($token ." " .$token2);
        if (0 !== @strcasecmp($token2, $token)) {
            return false;
        }
        return true;
    }

    public static function isEmail($str)
    {
        return @filter_var($str, FILTER_VALIDATE_EMAIL);
    }
    
    public static function isPhone($str)
    {
        if (1 === preg_match("/^1[358]{1}[0-9]{9}$/", $str)) {
            return true;
        }
        return false;
    }

    public static function isPassword($str)
    {
        if (preg_match("/^[0-9a-z]{32}$/", $str)) {
            return true;
        }
        return false;
    }

    public static function disable($controller)
    {
        $controller->view->disable();
    }

    public static function escape($val)
    {
        return @mysql_escape_string(@trim($val));
    }

    public static function now()
    {
        return time();
    }

    public static function eq($l, $r)
    {
        return (0 === @strcasecmp($l, $r));
    }

    public static function onExit($controller, $status, $msg)
    {
        MyTool::setVar($controller, MyConst::FIELD_STATUS, $status);
        MyTool::setVar($controller, MyConst::FIELD_MESSAGE, $msg);
        return true;
    }

    public static function simpleView($controller)
    {
        $controller->view->pick(MyConst::VIEW_STATUS);
    }
}
