<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class TeamController extends Controller
{
    public function getAction($targetId)
    {
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $targetId = @trim($targetId);
        if (empty($targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_PARAM, 'invalid param');
        }
        $team = TeamLogic::getTeam($targetId);
        if (empty($team)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_TEAM, 'unknown team id');
        }
        if ($team->flag != MyConst::TEAM_FLAG_NORMAL) {
            $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
            if (($team->owner != $uid) && !TeamLogic::hasMember($team->id, $uid)) {
                return MyTool::onExit($this, MyConst::STATUS_NO_PERMISSION, 'permission denied');
            }
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_TEAM, $team);

        $this->logger->log($team->mission);

        $leaders = TeamLogic::getLeaders($team->id);
        if (!empty($leaders)) {
            MyTool::setVar($this, MyConst::FIELD_LEADER, $leaders);
        }
        
        return true;
    }

    public function createAction()
    {
        MyTool::simpleView($this);
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $body = $this->request->getJsonRawBody();
        if (empty($body)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_PARAM, 'mal-json input data');
        }
        $team = TeamLogic::convert($body);
        if (empty($team)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_PARAM, 'invalid input');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $team->owner = $uid;
        try {
            if (false === $team->save()) {
                return MyTool::onExit($this, MyConst::STATUS_ERROR, "create team failed");
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, $e->getMessage());
        }

        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

    public function setAction($targetId, $field)
    {
        MyTool::simpleView($this);

        $field = @trim($field);
        $targetId = @intval($targetId);
        if (!array_key_exists($field, self::$FIELDS)) {
            return $this->onError(MyConst::STATUS_INVALID_PARAM, 'invalid param');
        }
        if (!MyTool::loginAuth($this)) {
            return $this->onError(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = MyTool::getCookie($this, MyConst::COOKIE_UID);
        $team = TeamLogic::getTeam($targetId);
        if (empty($team)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_TEAM, 'unknown team id');
        }
        if ($team->owner != $uid) {
            return MyTool::onExit($this, MyConst::STATUS_NO_PERMISSION, 'no premission');
        }
        $value = MyTool::get($this, MyConst::FIELD_VALUE);
        if (MyTool::eq($team->$field, $value)) {
            return MyTool::onExit($this, MyConst::STATUS_OK, 'nothing changed');
        }
        $team->$field = $value;
        $team->mtime = MyTool::now();
        try {
            if (true !== $team->update()) {
                return MyTool::onExit($this, MyConst::STATUS_ERROR, "update team failed");
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, $e->getMessage());
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

    static $FIELDS = array(
        MyConst::FIELD_NAME            => 0,
        MyConst::FIELD_MISSION         => 0,
        MyConst::FIELD_LOGO            => 0,
        MyConst::FIELD_INTRO           => 0,
        MyConst::FIELD_COMPANY         => 0,
        MyConst::FIELD_DOMAIN          => 0,
        MyConst::FIELD_STAGE           => 0,
        MyConst::FIELD_SIZE            => 0,
        MyConst::FIELD_ADDRESS         => 0
    );
}
