<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

/**
 * cgi/login/{user}/{password}
 */
class LoginController extends Controller
{
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

        MyTool::setCookie($this, MyConst::COOKIE_TOKEN, MyTool::uuid(), MyConst::COOKIE_EXPIRE);
        MyTool::setCookie($this, MyConst::COOKIE_UID, $user->id, MyConst::COOKIE_EXPIRE);
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
