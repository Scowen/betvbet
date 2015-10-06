<?php

use yii\db\Schema;
use yii\db\Migration;

class m151004_103623_insert_user_admin extends Migration
{
    public function up()
    {
        $this->insert("{{user}}", array(
            'email' => 'lmscowen@gmail.com',
            'password' => 'yAMatha19',
            'created' => time(),
            'admin' => 100,
        ));
    }

    public function down()
    {
        echo "m151004_103623_insert_user_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
