<?php

use yii\db\Schema;
use yii\db\Migration;

class m151011_144030_create_table_bet_slip extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{bet_slip}}',
            array(
                'id'                => $this->primaryKey(),
                'amount'            => $this->double(),
                'football_match'    => $this->integer(),
                'horse_race'        => $this->integer(),
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
        $this->dropTable('{{bet_slip}}');
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
