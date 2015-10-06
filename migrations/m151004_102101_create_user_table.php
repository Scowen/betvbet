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
                'id'          => 'pk                    ',
                'email'       => 'VARCHAR(128)  NOT NULL',
                'password'    => 'VARCHAR(128)  NOT NULL',
                'authKey'     => 'TEXT              NULL',
                'accessToken' => 'TEXT              NULL',
                'created'     => 'INT           NOT NULL',
                'active'      => 'BOOLEAN       NOT NULL DEFAULT FALSE',
                'admin'       => 'INT(3)        NOT NULL DEFAULT 10',
                'balance'     => 'DOUBLE        NOT NULL DEFAULT 0',
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
