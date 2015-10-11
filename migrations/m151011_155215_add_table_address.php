<?php

use yii\db\Schema;
use yii\db\Migration;

class m151011_155215_add_table_address extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{address}}',
            array(
                'id'                => $this->primaryKey(),
                'user'              => $this->integer(),
                'line1'             => $this->string(),
                'line2'             => $this->string(),
                'line3'             => $this->string(),
                'line4'             => $this->string(),
                'line5'             => $this->string(),
                'postcode'          => $this->string(),
                'country'           => $this->string(),
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
        $this->dropTable('{{address}}');
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
