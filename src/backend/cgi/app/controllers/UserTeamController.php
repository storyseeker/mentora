<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class UserTeamController extends Controller
{
    public function listAction()
    {
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $memberOf = TeamLogic::memberOf($uid);
        if (is_array($memberOf) && !empty($memberOf)) {
            $tids = "";
            for ($i = 0; $i < count($memberOf); $i++) {
                $tids .= ','. $memberOf->id;
            }
            $teams = TeamLogic::getTeams($tids);
            if (is_array($teams) && !empty($teams)) {
                $myTeams = array_merge($myTeams, $teams);
            }
        }
        if (empty($myTeams)) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, 'no teams');
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_USER, $myTeams);
        return true;
    }

    public function inviteAction()
    {
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $teams = MaTeamInvitation::invitations($uid);
        if (empty($myTeams)) {
            return MyTool::onExit($this, MyConst::STATUS_OK, 'no invitations');
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_USER, $teams);
        return true;
    }

    public function passAction($targetId)
    {
        MyTool:simpleView();
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $targetId = @intval($targetId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 查询加群邀请
        $invitation = MaTeamInvitation::invited($uid, $targetId);
        if (empty($invitation)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_EXISTS, 'invitation not exists');
        }

        // 判断是否已经是群成员
        if (TeamLogic::hasMember($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'already member of team');
        }
        if (TeamLogic::isOwner($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'owner of team');
        }
        
        // 更新邀请状态
        try {
            $invitation->pass();
            if (true !== $invitation->update()) {
                return MyTool::onExit($this, MyConst::STATUS_DB, 'update invitation fail');
            }
        } catch (Exceptioni $e) {
            return MyTool::onExit($this, MyConst::STATUS_DB, $e->getMessage());
        }

        // 添加一个成员
        $member = MaTeamMember::addMember($targetId, $uid);
        try {
            if (true !== $member->save()) {
                return MyTool::onExit($this, MyConst::STATUS_DB, 'add new member');
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_DB, $e->getMessage());
        }
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

    public function denyAction($targetId)
    {
        MyTool:simpleView();
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $targetId = @intval($targetId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 查询加群邀请
        $invitation = MaTeamInvitation::invited($uid, $targetId);
        if (empty($invitation)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_EXISTS, 'invitation not exists');
        }

        // 判断是否已经是群成员
        if (TeamLogic::hasMember($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'already member of team');
        }
        if (TeamLogic::isOwner($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'owner of team');
        }
        
        // 更新邀请状态
        try {
            $invitation->deny();
            if (true !== $invitation->update()) {
                return MyTool::onExit($this, MyConst::STATUS_DB, 'update invitation fail');
            }
        } catch (Exceptioni $e) {
            return MyTool::onExit($this, MyConst::STATUS_DB, $e->getMessage());
        }

        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

    public function applyAction($targetId)
    {
        MyTool:simpleView();
        if (!MyTool::loginAuth($this)) {
            return $this->onExit(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $targetId = @intval($targetId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 是否已申请过
        if (MaTeamInvitation::exists($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'record already exists');
        }

        // 获取用户信息
        $user = MaUser::getUser($uid);
        if (empty($user)) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, 'invalid user id');
        }

        // 获得团队信息
        $team = TeamLogic::getTeam($targetId);
        if (empty($team)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_TEAM, 'invalid team id');
        }
        if (TeamLogic::isOwner($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_OK, 'already owner of this team');
        }
        if (TeamLogic::hasMember($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_OK, 'already member of this team');
        }

        // 添加申请
        $apply = MaTeamInvitatoin::apply($team->id, $team->name, $user->id, $user->name);
        try {
            if (true !== $apply->create()) {
               return MyTool::onExit($this, MyConst::STATUS_DB, 'join in team apply failed');
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, $e->getMessage());
        }

        // 返回
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }
    
    public function deleteAction()
    {
        // 使用默认视图
        MyTool:simpleView();
      
        // 验证登录状态
        if (!MyTool::loginAuth($this)) {
            return $this->onExit(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $targetId = @intval($targetId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 获取团队信息
        $team = TeamLogic::getTeam($targetId);
        if (empty($team)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_TEAM, 'invalid team id');
        }
        if (TeamLogic::isOwner($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, 'owner of team');
        }

        // 团队成员
        $member = MaTeamMember::getMember($targetId, $uid);
        if (empty($member)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_EXISTS, 'not a member of team');
        }

        // 删除成员
        try {
            if (true !== $member->delete()) {
                return MyTool::onExit($this, MyConst::STATUS_DB, 'delete team fail');
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, $e->getMessage());
        }

        // 返回
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

}
