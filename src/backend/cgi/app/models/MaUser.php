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

    public static function getUser($account)
    {
        $userId = null;
        if (MyTool::isEmail($account)) {
            $userId = sprintf("%s='%s'", MyConst::FIELD_EMAIL, $account);
        }
        else if (MyTool::isPhone($account)) {
            $userId = sprintf("%s='%s'", MyConst::FIELD_PHONE, $account);
        }
        else {
            $userId = sprintf("id=%s", $account);
        }
        return MaUser::findFirst($userId);
    }
}
