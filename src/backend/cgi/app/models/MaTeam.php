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
        $this->useDynamicUpdate(true);
    }

    public function getSource()
    {
        return self::$TBL_NAME;
    }

    public static function getTeam($tid)
    {
        $condition = sprintf("id=%d", $tid);
        return MaTeam::findFirst($condition);
    }

    public function afterFetch()
    {
        if (empty($this->name)) {
            $this->name = ' ';
        }
        if (empty($this->mission)) {
            $this->mission = ' ';
        }
        if (empty($this->logo)) {
            $this->logo = ' ';
        }
        if (empty($this->intro)) {
            $this->intro = ' ';
        }
        if (empty($this->company)) {
            $this->company = ' ';
        }
        if (empty($this->domain)) {
            $this->domain = ' ';
        }
        if (empty($this->stage)) {
            $this->stage = ' ';
        }
        if (empty($this->size)) {
            $this->size = ' ';
        }
        if (empty($this->address)) {
            $this->address = ' ';
        }
    }
}
