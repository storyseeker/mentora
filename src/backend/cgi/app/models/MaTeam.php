<?php

use Phalcon\Mvc\Model;

class MaTeam extends Model
{
    private static $TBL_NAME = "ma_team";

    public $id;
    public $owner;
    public $flag;
    public $name;
    public $mission;
    public $logo;
    public $intro;
    public $company;
    public $domain;
    public $stage;
    public $size;
    public $address;
    public $status;
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
