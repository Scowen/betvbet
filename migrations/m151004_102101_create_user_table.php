<?php

use yii\db\Schema;
use yii\db\Migration;

class m151004_102101_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{user}}',
            array(
                'id'          => $this->primaryKey(),
                'email'       => $this->string(128)->notNull(),
                'password'    => $this->string(128)->notNull(),
                'authKey'     => $this->text(),
                'accessToken' => $this->text(), 
                'active'      => $this->boolean()->notNull()->defaultValue(FALSE),
                'admin'       => $this->integer()->notNull()->defaultValue(10),
                'balance'     => $this->double()->notNull()->defaultValue(0),
                'created'     => $this->integer()->notNull(),
            ),
            implode(' ', array(
                'ENGINE          = InnoDB',
                'DEFAULT CHARSET = utf8',
                'COLLATE         = utf8_general_ci',
                'COMMENT         = ""',
                'AUTO_INCREMENT  = 1',
            ))
        );
    }

    public function down()
    {
        $this->dropTable("{{user}}");
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
