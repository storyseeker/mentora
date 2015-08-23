<?php

use Phalcon\Mvc\Model;

class MaTeamMember extends Model
{
    private static $TBL_NAME = "ma_team_member";

    public $tid;
    public $uid;
    public $flag;
    public $ctime;
    public $mtime;
    public $deleted;

    public function initialize()
    {
        $this->setSource(self::$TBL_NAME);
    }

    public function getSource()
    {
        return self::$TBL_NAME;
    }
    
    public static function addMember($tid, $uid)
    {
        $member = new MaTeamMember();
        $member->ctime = MyTool::now();
        $member->mtime = $member->ctime;
        $member->flag = 0;
        $member->deleted = 0;
        $member->tid = $tid;
        $member->uid = $uid;
        return $member;
    }

    public static function getMember($tid, $uid)
    {
        $condition = sprintf('tid=%d AND uid=%d AND deleted=0', $tid, $uid);
        return MaTeamMember::findFirst($condition);
    }

    public static function getMembers($tid)
    {
        $condition = sprintf('tid=%d AND deleted=0', $tid, $uid);
        return MaTeamMember::find($condition);
    }
}
