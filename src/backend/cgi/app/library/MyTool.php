<?php

class MyTool
{
    public static function get($pthis, $name, $defaultValue = null)
    {
        if ($pthis->request->has($name))
        {
            return $pthis->request->get($name);
        }
        return $pthis->dispatcher->getParam($name, $defaultValue);
    }

    public static function setVar($pthis, $name, $value)
    {
        $pthis->view->setVar($name, $value);
    }

    public static function hasCookie($pthis, $name)
    {
        return $pthis->cookies->has($name);
    }

    public static function getCookie($pthis, $name)
    {
        if ($pthis->cookies->has($name))
        {
            return $pthis->cookies->get($name);
        }
        return null;
    }

    public static function setCookie($pthis, $name, $value, $expire)
    {
        $pthis->cookies->set($name, $value, time() + $expire);
    }

    public static function uuid()
    {
        return md5(time());
    }

    public static function isEmail($str)
    {
        return @filter_var($str, FILTER_VALIDATE_EMAIL);
    }
}
