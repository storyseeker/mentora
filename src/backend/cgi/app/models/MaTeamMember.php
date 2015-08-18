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
}
