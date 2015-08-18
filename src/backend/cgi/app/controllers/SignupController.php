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
        $user = SignupLogic::convert($body);
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
            if (false === SignupLogic::create($user)) {
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
        MyTool::simpleView();
        return true;
    }
}
