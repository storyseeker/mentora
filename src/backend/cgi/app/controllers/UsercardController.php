<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class UserCardController extends Controller
{

    public function getAction($targetUid = '')
    {
        if (!MyTool::loginAuth($this)) {
            return $this->onError(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $targetUid = $this->convert($targetUid);
        if (empty($targetUid)) {
            $targetUid = $uid;
        }
        if (empty($targetUid)) {
            return $this->onError(MyConst::STATUS_INVALID_PARAM, 'invalid param');
        }
        $user = $this->getUserInfo($targetUid);
        if (empty($user)) {
            return $this->onError(MyConst::STATUS_INVALID_USER, 'unknown user id');
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_USER, $user);
        MyTool::setVar($this, MyConst::FIELD_SELF, $this->isMyself($user, $uid));

        return true;
    }

    public function setAction($field)
    {
        $field = @trim($field);
        if (!array_key_exists($field, self::FIELDS)) {
            return $this->onError(MyConst::STATUS_INVALID_PARAM, 'invalid param');
        }
        if (!MyTool::loginAuth($this)) {
            return $this->onError(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = MyTool::getCookie($this, MyConst::COOKIE_UID);
        $user = $this->getUserInfo($uid);
        if (empty($user)) {
            return $this->onError(MyConst::STATUS_INVALID_USER, 'unknown user id');
        }
        $value = MyTool::get($this, MyConst::FIELD_VALUE);
        $value2 = null;
        if (0 === strcasecmp($user->$field, $value)) {
            return $this->onError(MyConst::STATUS_OK, 'nothing changed');
        }
        if (strcasecmp($field, MyConst::FIELD_PASSWORD)) {
            $value2 = MyTool::get($this, MyConst::FIELD_VALUE2);
            if (0 !== strcasecmp($user->$field, $value2)) {
                return $this->onError(MyConst::STATUS_WRONG_PASSWORD, 'current password wrong');
            }
        }
        $user->$field = $value;
    }
    
    private function convert($targetUid) {
        $targetUid = @trim($targetUid);
        if (MyTool::isEmail($targetUid)) {
            return $targetUid;
        }
        else if (MyTool::isPhone($targetUid)) {
            return $targetUid;
        }
        return @intval($targetUid);
    }

    private function isMyself($user, $uid) {
        return ($user->id == $uid);
    }

    private function onError($status, $msg)
    {
        MyTool::setVar($this, MyConst::FIELD_STATUS, $status);
        MyTool::setVar($this, MyConst::FIELD_MESSAGE, $msg);
        return true;
    }

    private function getUserInfo($account)
    {
        $userId = null;
        if (MyTool::isEmail($account)) {
            $userId = sprintf("%s='%s'", MyConst::FIELD_EMAIL, $account);
        }
        else if (MyTool::isPhone($account)) {
            $userId = sprintf("%s='%s'", MyConst::FIELD_PHONE, $account);
        }
        else {
            $userId = sprintf("id=%s", $account);
        }
        return MaUser::findFirst($userId);
    }

    private const FIELDS = array(
      'phone' => 0,
      'emial' => 0,
      'company' => 0,
      'job' => 0,
      'weibo' => 0,
      'weixin' => 0,
      'open' => 0,
      'linkedin' => 0,
      'github' => 0
    );
}
