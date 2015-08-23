<?php
use Phalcon\Mvc\Model;

class MaUserInvitation extends Model
{
    private static $TBL_NAME = "ma_user_invitation";

    public $id;
    public $uid; // inviter
    public $uname;
    public $uid2; // invitee
    public $uname2;
    public $flag; // 0 - friend, 1 - mentor
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
}
