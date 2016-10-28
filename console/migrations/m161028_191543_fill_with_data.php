<?php

use yii\base\Model;
use yii\db\Migration;
use common\models\User;

class m161028_191543_fill_with_data extends Migration
{
    public function up()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = '';
        $user->setPassword('admin');
        $user->generateAuthKey();
        
        $user->save();
    }

    public function down()
    {
        echo "m161028_191543_fill_with_data cannot be reverted.\n";

        return false;
    }
}
