<?php

use yii\db\Schema;
use yii\db\Migration;

class m151011_150344_create_table_logs extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{logs}}',
            array(
                'id'                => $this->primaryKey(),
                'severity'          => $this->integer(),
                'type'              => $this->string(),
                'user'              => $this->integer(),
                'ip'                => $this->string(),
                'page'              => $this->string(),
                'message'           => $this->text(),
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
        $this->dropTable('{{logs}}');
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
