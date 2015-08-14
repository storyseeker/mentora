<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    /**
     * cgi/login/{user}/{password}
     */
    public function indexAction()
    {
        $account = @trim(MyTool::get($this, MyConst::PARAM_USER_ACCOUNT));
        $password = @trim(MyTool::get($this, MyConst::PARAM_USER_PASSWORD));

        if (!$this->checkParams($account, $password)) {
            return $this->onError(MyConst::STATUS_INVALID_PARAM, 'need account and password');
        }

        $user = $this->getUserInfo($account);
        if (empty($user)) {
            return $this->onError(MyConst::STATUS_INVALID_USER, 'unknown user id');
        }

        if (!$this->checkPassword($user, $password)) {
            return $this->onError(MyConst::STATUS_INVALID_PASSWORD, 'invalid password');
        }

        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_USER, $user);

        $ts = time();
        if (!MyTool::hasCookie($this, MyConst::COOKIE_UUID)) {
            MyTool::setCookie($this, MyConst::COOKIE_UUID, MyTool::genUuid($ts), MyConst::COOKIE_NEVER_EXPIRE);
        }
        MyTool::setCookie($this, MyConst::COOKIE_TOKEN, MyTool::genToken($user->id, $ts), MyConst::COOKIE_EXPIRE);
        MyTool::setCookie($this, MyConst::COOKIE_UID, $user->id, MyConst::COOKIE_EXPIRE);
        MyTool::setCookie($this, MyConst::COOKIE_TS, $ts, MyConst::COOKIE_EXPIRE);

        return true;
    }

    /**
     * cgi/logout
     */
    public function logoutAction()
    {
        $message = '';
        if (MyTool::hasCookie($this, MyConst::COOKIE_TOKEN))
        {
            $message .= "token: ". MyTool::getCookie($this, MyConst::COOKIE_TOKEN). ',';
            $this->cookies->get(MyConst::COOKIE_TOKEN)->delete();
        }
        if (MyTool::hasCookie($this, MyConst::COOKIE_UID))
        {
            $message .= "uid: ". MyTool::getCookie($this, MyConst::COOKIE_UID). ',';
            $this->cookies->get(MyConst::COOKIE_UID)->delete();
        }
        if (MyTool::hasCookie($this, MyConst::COOKIE_TS))
        {
            $message .= "ts: ". MyTool::getCookie($this, MyConst::COOKIE_TS). ',';
            $this->cookies->get(MyConst::COOKIE_TS)->delete();
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_MESSAGE, $message);
        return true;
    }

    private function checkParams($account, $password)
    {
        if (empty($account)) {
            return false;
        }
        if (empty($password)) {
            return false;
        }
        return true;
    }

    private function onError($status, $msg)
    {
        MyTool::setVar($this, MyConst::FIELD_STATUS, $status);
        MyTool::setVar($this, MyConst::FIELD_MESSAGE, $msg);
        return true;
    }

    private function checkPassword($user, $password)
    {
        return (0 === strcasecmp($user->password, $password));
    }

    private function getUserInfo($account)
    {
        $userId = null;
        if (MyTool::isEmail($account))
        {
            $userId = sprintf("%s='%s'", MyConst::FIELD_EMAIL, $account);
        }
        else
        {
            $userId = sprintf("%s='%s'", MyConst::FIELD_PHONE, $account);
        }
        return MaUser::findFirst($userId);
    }
}
