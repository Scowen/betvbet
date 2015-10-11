<?php

use yii\db\Schema;
use yii\db\Migration;

class m151011_145743_create_table_bets extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{bets}}',
            array(
                'id'                => $this->primaryKey(),
                'bet_slip'          => $this->integer(),
                'user'              => $this->integer(),
                'selection'         => $this->integer(),
                'last_updated'      => $this->integer()->notNull(),
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
        $this->dropTable('{{bets}}');
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
