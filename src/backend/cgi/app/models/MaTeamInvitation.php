<?php
use Phalcon\Mvc\Model;

class MaTeamInvitation extends Model
{
    private static $TBL_NAME = "ma_team_invitation";

    public $id;
    public $tid;
    public $tname;
    public $uid;
    public $uname;
    public $flag; // 0 - invite, 1 - apply
    public $status; // 0 - init, 1 - pass, 2 - deny
    public $ctime;
    public $mtime;

    public function initialize()
    {
        $this->setSource(self::$TBL_NAME);
        $this->useDynamicUpdate(true);
    }

    public function getSource()
    {
        return self::$TBL_NAME;
    }

    public static function invitations($uid)
    {
        $condition = sprintf("uid=%d AND flag=0 AND status=0", $uid);
        return MaTeamInvitation::find($condition);
    }

    public static function applies($tid)
    {
        $condition = sprintf("tid=%d AND flag=1 AND status=0", $tid);
        return MaTeamInvitation::find($condition);
    }

    public static function invite($tid, $tname, $uid, $uname)
    {
        $invite = new MaTeamInvitation();
        $invite->ctime = MyTool::now();
        $invite->mtime = $invite->ctime;
        $invite->flag = 0;
        $invite->status = 0;
        $invite->tid = tid;
        $invite->tname = tname;
        $invite->uid = uid;
        $invite->uname = uname;
        return $invite;
    }

    public static function apply($tid, $tname, $uid, $uname)
    {
        $apply = new MaTeamInvitation();
        $apply->ctime = MyTool::now();
        $apply->mtime = $invite->ctime;
        $apply->flag = 1;
        $apply->status = 0;
        $apply->tid = tid;
        $apply->tname = tname;
        $apply->uid = uid;
        $apply->uname = uname;
        return $apply;
    }

    public static funtion exists($tid, $uid)
    {
        $condition = sprintf("tid=%d AND uid=%d", $tid, $uid);
        $one = MaTeamInvitation::findFirst($condition);
        if (empty($one))  {
            return false;
        }
        return true;
    }

    public static funtion invited($tid, $uid)
    {
        $condition = sprintf("tid=%d AND uid=%d AND flag=0", $tid, $uid);
        return MaTeamInvitation::findFirst($condition);
    }

    public static funtion applied($tid, $uid)
    {
        $condition = sprintf("tid=%d AND uid=%d AND flag=1", $tid, $uid);
        return MaTeamInvitation::findFirst($condition);
    }

    public function pass()
    {
        $this->status = 1;
    }

    public function deny()
    {
        $this->status = 2;
    }
}
