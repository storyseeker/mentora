<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class UserCardController extends Controller
{
    public function getAction($targetUid = '')
    {
        $this->logger->log("request in");
        if (!MyTool::loginAuth($this)) {
            return $this->onError(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        if (empty($targetUid)) {
            $targetUid = $uid;
        }
        else {
            $targetUid = @intval($targetUid);
        }
        if (empty($targetUid)) {
            return $this->onError(MyConst::STATUS_INVALID_PARAM, 'invalid param');
        }
        $user = $this->getUserInfo($targetUid);
        if (empty($user)) {
            return $this->onError(MyConst::STATUS_INVALID_USER, 'unknown user id');
        }
        if ($uid == $targetUid) {
            MyTool::setVar($this, MyConst::FIELD_SELF, true);
        }
        else {
            MyTool::setVar($this, MyConst::FIELD_SELF, false);
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_USER, $user);

        return true;
    }

    private function onError($status, $msg)
    {
        MyTool::setVar($this, MyConst::FIELD_STATUS, $status);
        MyTool::setVar($this, MyConst::FIELD_MESSAGE, $msg);
        return true;
    }

    private function getUserInfo($account)
    {
        $userId = sprintf("id=%s", $account);
        return MaUser::findFirst($userId);
    }
}
