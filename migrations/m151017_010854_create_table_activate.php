<?php

use yii\db\Schema;
use yii\db\Migration;

class m151017_010854_create_table_activate extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{activate}}',
            array(
                'id'                => $this->primaryKey(),
                'user'              => $this->integer()->notNull(),
                'code'              => $this->string()->notNull(),
                'expires'           => $this->integer()->notNull(),
                'created'           => $this->integer()->notNull(),
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
        $this->dropTable('{{activate}}');
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
