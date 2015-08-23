<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class TeamMemberController extends Controller
{
    public function listAction($targetId)
    {
        // 登录验证
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $tid = @intval($targetId);
        
        // 获取团队信息
        $team = MaTeam::getTeam($tid);

        // 私有权限
        if ($team->flag == MyConst::TEAM_FLAG_MYSPACE && $team->owner != $uid) {
            return MyTool::onExit($this, MyConst::STATUS_NO_PERMISSION, 'not owner of myspace');
        }
        
        if ($team->owner != $uid) {
            // 判断是否是群成员
            $member = MaTeamMember::getMember($tid, $uid);
            if ($team->owner != $uid && empty($member)) {
                return MyTool::onExit($this, MyConst::STATUS_NO_PERMISSION, 'not a member of team');
            }
        }

        // 获取成员列表
        $members = MaTeamMember::getMembers($tid);
        if (empty($members)) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, 'get members of team fail');
        }

        // 获取用户信息
        $condition = $members[0];
        for ($i = 1; $i < count($members); $i++) {
            $condition .= ','. $members[$i];
        }
        $users = MaUser::find($condition);
        if (empty($users)) {
            return MyTool::onExit($this, MyConst::STATUS_DB, 'get users of team fail');
        }

        // 返回
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_USER, $users);
        return true;
    }

    public function applyAction($targetId)
    {
        // 登录验证
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $tid = @intval($targetId);

        // 判断是否是管理员
        if (!TeamLogic::isOwner($uid, $targetId)) {
            return MyTool::onExit($this, MyConst::STATUS_NO_PERMISSION, 'not owner of team');
        }
      
        // 申请列表
        $applies = MaTeamInvitation::applies($tid);
        if (empty($applies)) {
            return MyTool::onExit($this, MyConst::STATUS_OK, 'no applies');
        }

        // 返回
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        MyTool::setVar($this, MyConst::FIELD_INVITE, $applies);
        return true;
    }

    public function inviteAction($teamId, $userId)
    {
        MyTool::simpleView();

        // 登录验证
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));
        $teamId = @intval($teamId);

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

        // 判断是否是管理员
        if ($team->owner != $user->id) {
            return MyTool::onExit($this, MyConst::STATUS_NO_PERMISSION, 'not owner of team');
        }

        // 查询加群邀请
        $invitation = MaTeamInvitation::applied($userId, $teamId);
        if (!empty($invitation)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'invite exists');
        }
      
        // 发出邀请
        $invite = MaTeamInvitaion::invite($team->id, $team->name, $user->id, $user->name);
        try {
            if (true !== $invite->create()) {
               return MyTool::onExit($this, MyConst::STATUS_DB, 'invite failed');
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, $e->getMessage());
        }

        // 返回
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

    public function passAction($teamId, $userId)
    {
        MyTool:simpleView();

        // 登录验证
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $teamId = @intval($teamId);
        @userId = @intval($userId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 查询加群申请
        $apply = MaTeamInvitation::applied($userId, $teamId);
        if (empty($apply)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_EXISTS, 'apply not exists');
        }

        // 判断是否已经是群成员
        if (TeamLogic::hasMember($uid, $teamId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'already member of team');
        }
        if (TeamLogic::isOwner($uid, $teamId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'owner of team');
        }
        
        // 更新邀请状态
        try {
            $apply->pass();
            if (true !== $apply->update()) {
                return MyTool::onExit($this, MyConst::STATUS_DB, 'update apply fail');
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_DB, $e->getMessage());
        }

        // 添加一个成员
        $member = MaTeamMember::addMember($teamId, $userId);
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

    public function denyAction($teamId, $userId)
    {
        MyTool:simpleView();

        // 登录验证
        if (!MyTool::loginAuth($this)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $teamId = @intval($teamId);
        @userId = @intval($userId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 查询加群申请
        $apply = MaTeamInvitation::applied($userId, $teamId);
        if (empty($apply)) {
            return MyTool::onExit($this, MyConst::STATUS_NOT_EXISTS, 'apply not exists');
        }

        // 判断是否已经是群成员
        if (TeamLogic::hasMember($uid, $teamId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'already member of team');
        }
        if (TeamLogic::isOwner($uid, $teamId)) {
            return MyTool::onExit($this, MyConst::STATUS_EXISTS, 'owner of team');
        }
        
        // 更新邀请状态
        try {
            $apply->deny();
            if (true !== $apply->update()) {
                return MyTool::onExit($this, MyConst::STATUS_DB, 'update apply fail');
            }
        } catch (Exception $e) {
            return MyTool::onExit($this, MyConst::STATUS_DB, $e->getMessage());
        }

        // 返回
        MyTool::setVar($this, MyConst::FIELD_STATUS, MyConst::STATUS_OK);
        return true;
    }

    public function deleteAction($teamId, $userId)
    {
        // 使用默认视图
        MyTool:simpleView();
      
        // 验证登录状态
        if (!MyTool::loginAuth($this)) {
            return $this->onExit(MyConst::STATUS_NOT_LOGIN, 'must login first');
        }
        $teamId = @intval($teamId);
        $userId = @intval($userId);
        $uid = @intval(MyTool::getCookie($this, MyConst::COOKIE_UID));

        // 获取团队信息
        $team = TeamLogic::getTeam($teamId);
        if (empty($team)) {
            return MyTool::onExit($this, MyConst::STATUS_INVALID_TEAM, 'invalid team id');
        }
        if (TeamLogic::isOwner($uid, $teamId)) {
            return MyTool::onExit($this, MyConst::STATUS_ERROR, 'owner of team');
        }

        // 团队成员
        $member = MaTeamMember::getMember($teamId, $userId);
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
