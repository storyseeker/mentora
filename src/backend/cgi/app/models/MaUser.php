<?php

use Phalcon\Mvc\Model;

class MaUser extends Model
{
    private static $TBL_NAME = "ma_user";

    public $id;
    public $password;
    public $name;
    public $phone;
    public $email;
    public $pic;
    public $company;
    public $job;
    public $open;
    public $weibo;
    public $weixin;
    public $linkedin;
    public $github;
    public $status;
    public $ctime;
    public $mtime;

    public function initialize()
    {
        $this->setSource(self::$TBL_NAME);
    }

    public function getSource()
    {
        return self::$TBL_NAME;
    }
}
