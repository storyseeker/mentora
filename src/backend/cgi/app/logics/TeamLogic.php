<?php

class TeamLogic
{
    public static function getMate($uid)
    {
        $uid = @intval($uid);
        $condition = sprintf("owner=%d AND flag=%d", $uid, MyConst::TEAM_FLAG_MYMATE);
        return MaTeam::findFirst($condition);
    }

    public static function getTeam($tid)
    {
        $tid = @intval($tid);
        $condition = sprintf("id=%d", $tid);
        return MaTeam::findFirst($condition);
    }

    public static function hasMember($uid, $tid)
    {
        $condition = sprintf('tid=%d AND uid=%d AND deleted=0', $tid, $uid);
        $member = MaTeamMember::findFirst(array(
            'conditions' => $condition, 
            'columns'    => 'tid'
        ));
        if (!empty($member)) {
            return true;
        }
        return false;
    }

    public static function isOwner($uid, $tid)
    {
        $condition = sprintf('id=%d AND owner=%d', $tid, $uid);
        $owner = MaTeam::findFirst(array(
            'conditions' => $condition, 
            'columns'    => 'id'
        ));
        if (empty($owner)) {
            return false;
        }
        return true;
    }

    public static function getLeaders($tid)
    {
        $condition = sprintf('tid=%d AND deleted=0', $tid);
        $leaders = MaTeamLeader::find($condition);
        if (0 === @count($leaders)) {
            return null;
        }
        return $leaders;
    }

    public static function convert($json)
    {
        $team = new MaTeam();
        if (!self::fill($json, $team, MyConst::FIELD_FLAG)) {
            return false;
        }
        $team->flag = @intval($json->flag);
        if ($team->flag < MyConst::TEAM_FLAG_BEGIN || $team->flag > MyConst::TEAM_FLAG_END) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_NAME)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_MISSION)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_LOGO)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_INTRO)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_STAGE)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_COMPANY)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_SIZE)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_ADDRESS)) {
            return false;
        }
        if (!self::fill($json, $team, MyConst::FIELD_DOMAIN)) {
            return false;
        }

        $team->mtime = MyTool::now();
        $team->ctime = $team->mtime;
    
        $team->status = 0;
        $team->deleted = 0;

        return $team;
    }

    private static function fill($json, $team, $field, $required = true)
    {
        if (!isset($json->$field)) {
            return false;
        }
        $team->$field = @trim($json->$field);
        if ($required && 0 === strlen($team->$field)) {
            return false;
        }
        return true;
    }
}
