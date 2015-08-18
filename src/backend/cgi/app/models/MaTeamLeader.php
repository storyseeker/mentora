<?php

use Phalcon\Mvc\Model;

class MaTeamLeader extends Model
{
    private static $TBL_NAME = "ma_team_leader";

    public $id;
    public $tid;
    public $name;
    public $pic;
    public $role;
    public $intro;
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

    public function afterFetch()
    {
        if (empty($this->name)) {
            $this->name = ' ';
        }
        if (empty($this->role)) {
            $this->role = ' ';
        }
        if (empty($this->intro)) {
            $this->intro = ' ';
        }
        if (empty($this->pic)) {
            $this->pic = ' ';
        }
    }
}
