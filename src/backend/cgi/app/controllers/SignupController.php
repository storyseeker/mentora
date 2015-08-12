<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    /**
     * cgi/singup
     */
    public function indexAction()
    {
        $body = $this->request->getJsonRawBody();
        if (empty($body)) {
            return $this->onExit(MyConst::STATUS_INVALID_PARAM, 'mal-json input data');
        }
        $user = $this->jsonToUser($body);
        if (empty($user)) {
            return $this->onExit(MyConst::STATUS_INVALID_PARAM, 'missing some required field');
        }
        if (!MyTool::isEmail($user->email)) {
            return $this->onExit(MyConst::STATUS_INVALID_EMAIL, 'bad email input');
        }
        if (!MyTool::isPhone($user->phone)) {
            return $this->onExit(MyConst::STATUS_INVALID_EMAIL, 'bad phone input');
        }
        if (!MyTool::isPassword($user->password)) {
            return $this->onExit(MyConst::STATUS_INVALID_EMAIL, 'bad password input');
        }
        try {
            if (true !== $user->create()) {
                return $this->onExit(MyConst::STATUS_ERROR, 'system error');
            }
        } catch (Exception $e) {
            return $this->onExit(MyConst::STATUS_ERROR, $e->getMessage());
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, 'user', $user);
        return true;
    }

    /**
     * cgi/singup/verify/email/{email}
     */
    public function checkEmailAction($email)
    {
        $email = @trim($email);
        if (!MyTool::isEmail($email)) {
            return $this->onExit(MyConst::STATUS_INVALID_EMAIL, 'wrong email address: ' .$email);
        }

        $userId = sprintf("%s='%s'", MyConst::FIELD_EMAIL, $email);
        $number = @intval(MaUser::count($userId));
        if ($number > 0) {
            return $this->onExit(MyConst::STATUS_EMAIL_EXISTS, 'email address already exists');
        }
        return $this->onExit(MyConst::STATUS_OK);
    }

    /**
     * cgi/singup/verify/phone/{phone}
     */
    public function checkPhoneAction($phone)
    {
        $phone = @trim($phone);
        if (!MyTool::isPhone($phone)) {
            return $this->onExit(MyConst::STATUS_INVALID_PHONE, 'wrong phone number: ' .$phone);
        }
        $userId = sprintf("%s='%s'", MyConst::FIELD_PHONE, $phone);
        $number = MaUser::count($userId);
        if ($number > 0) {
            return $this->onExit(MyConst::STATUS_PHONE_EXISTS, 'phone number already exists');
        }
        return $this->onExit(MyConst::STATUS_OK);
    }

    private function onExit($status, $msg = '')
    {
        MyTool::setVar($this, MyConst::FIELD_STATUS, $status);
        MyTool::setVar($this, MyConst::FIELD_MESSAGE, $msg);
        $this->view->pick(MyConst::VIEW_STATUS);
        return true;
    }

    private function jsonToUser($json)
    {
        $user = new MaUser();

        // user name, required
        if (!isset($json->name)) {
            return false;
        }
        $user->name = @trim($json->name);
        if (empty($user->name)) {
            return false;
        }

        // user password, required
        if (!isset($json->password)) {
            return false;
        }
        $user->password = @trim($json->password);
        if (empty($user->password)) {
            return false;
        }

        // user phone number, required
        if (!isset($json->phone)) {
            return false;
        }
        $user->phone = @trim($json->phone);
        if (empty($user->phone)) {
            return false;
        }

        // user email, required
        if (!isset($json->email)) {
            return false;
        }
        $user->email = @trim($json->email);
        if (empty($user->email)) {
            return false;
        }

        // user company or school or institude, required
        if (!isset($json->email)) {
            return false;
        }
        $user->company = @trim($json->company);
        if (empty($user->company)) {
            return false;
        }

        // user job position or title, required
        if (!isset($json->job)) {
            return false;
        }
        $user->job = @trim($json->job);
        if (empty($user->job)) {
            return false;
        }

        // searchable or not
        $user->open = 0;
        if (isset($json->open)) {
            $user->open = @intval(@trim($json->open));
            if ($user->open != 0) {
                $user->open = 1;
            }
        }
        else {
            $user->open = 0;
        }

        // user weibo account or uri, optional
        if (isset($json->weibo)) {
            $user->weibo = @trim($json->weibo);
        }

        // user weixin account or uri, required
        if (!isset($json->weixin)) {
            return false;
        }
        $user->weixin = @trim($json->weixin);
        if (empty($user->weixin)) {
            return false;
        }

        // user linkedin account or uri, required
        if (!isset($json->linkedin)) {
            return false;
        }
        $user->linkedin = @trim($json->linkedin);
        if (empty($user->linkedin)) {
            return false;
        }

        // user github account or uri, required
        if (isset($json->github)) {
            $user->github = @trim($json->github);
        }

        // user head pic uri, optional
        if (isset($json->pic)) {
            $user->pic = @trim($json->pic);
        }

        $user->mtime = time();
        $user->ctime = time();
    
        $user->status = 0;

        return $user;
    }
}
