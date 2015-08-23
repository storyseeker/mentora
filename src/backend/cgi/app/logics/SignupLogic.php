<?php

use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class SignupLogic
{
    public static function create($user)
    {
        $manager = new TransactionManager();
        $transaction = $manager->get();
        $user->setTransaction($transaction);
        if (true !== $user->create()) {
            $transaction->rollback("create user failed");
            return false;
        }
        $userId = sprintf("%s='%s'", MyConst::FIELD_EMAIL, $user->email);
        $user = MaUser::findFirst($userId);
        if (empty($user)) {
            $transaction->rollback("cannot find user created");
            return false;
        }

        $myspace = new MaTeam();
        $myspace->setTransaction($transaction);
        $myspace->owner = $user->id;
        $myspace->name = 'MyMate';
        $myspace->mission = 'Record My Growths';
        $myspace->flag = MyConst::TEAM_FLAG_MYSPACE;
        if (true !== $myspace->create()) {
            $transaction->rollback("create myspace failed");
            return false;
        }

        $mymate = new MaTeam();
        $mymate->setTransaction($transaction);
        $mymate->owner = $user->id;
        $mymate->name = 'MyMate';
        $mymate->mission = 'Follow and Share Growths With My Closest Friends';
        $mymate->flag = MyConst::TEAM_FLAG_MYMATE;
        if (true !== $mymate->create()) {
            $transaction->rollback("create mymate failed");
            return false;
        }

        $mentora = new MaTeam();
        $mentora->setTransaction($transaction);
        $mentora->owner = $user->id;
        $mentora->name = 'Mentors';
        $mentora->flag = MyConst::TEAM_FLAG_MENTOR;
        if (true !== $mentora->create()) {
            $transaction->rollback("create mentora failed");
            return false;
        }

        $newbie = new MaTeam();
        $newbie->setTransaction($transaction);
        $newbie->owner = $user->id;
        $newbie->name = 'Students';
        $newbie->flag = MyConst::TEAM_FLAG_MENTOR;
        if (true !== $newbie->create()) {
            $transaction->rollback("create newbie failed");
            return false;
        }

        $transaction->commit();

        return true;
    }

    public static function convert($json)
    {
        $user = new MaUser();

        // user name, required
        if (!isset($json->name)) {
            return false;
        }
        $user->name = @trim($json->name);
        if (empty($user->name)) {
            return false;
        }

        // user password, required
        if (!isset($json->password)) {
            return false;
        }
        $user->password = @trim($json->password);
        if (empty($user->password)) {
            return false;
        }

        // user phone number, required
        if (!isset($json->phone)) {
            return false;
        }
        $user->phone = @trim($json->phone);
        if (empty($user->phone)) {
            return false;
        }

        // user email, required
        if (!isset($json->email)) {
            return false;
        }
        $user->email = @trim($json->email);
        if (empty($user->email)) {
            return false;
        }

        // user company or school or institude, required
        if (!isset($json->email)) {
            return false;
        }
        $user->company = @trim($json->company);
        if (empty($user->company)) {
            return false;
        }

        // user job position or title, required
        if (!isset($json->job)) {
            return false;
        }
        $user->job = @trim($json->job);
        if (empty($user->job)) {
            return false;
        }

        // searchable or not
        $user->open = 0;
        if (isset($json->open)) {
            $user->open = @intval(@trim($json->open));
            if ($user->open != 0) {
                $user->open = 1;
            }
        }
        else {
            $user->open = 0;
        }

        // user weibo account or uri, optional
        if (isset($json->weibo)) {
            $user->weibo = @trim($json->weibo);
        }

        // user weixin account or uri, required
        if (!isset($json->weixin)) {
            return false;
        }
        $user->weixin = @trim($json->weixin);
        if (empty($user->weixin)) {
            return false;
        }

        // user linkedin account or uri, required
        if (!isset($json->linkedin)) {
            return false;
        }
        $user->linkedin = @trim($json->linkedin);
        if (empty($user->linkedin)) {
            return false;
        }

        // user github account or uri, required
        if (isset($json->github)) {
            $user->github = @trim($json->github);
        }

        // user head pic uri, optional
        if (isset($json->pic)) {
            $user->pic = @trim($json->pic);
        }

        $user->mtime = MyTool::now();
        $user->ctime = MyTool::now();
    
        $user->status = 0;
        $user->deleted = 0;

        return $user;
    }
}
