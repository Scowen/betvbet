<?php

use yii\db\Schema;
use yii\db\Migration;

class m151006_225409_create_table_match extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{match}}',
            array(
                'id'                => $this->primaryKey(),
                'match_id'          => $this->integer()->notNull(),
                'comp_id'           => $this->integer()->notNull(),
                'match_date'        => $this->integer()->notNull(),
                'status'            => $this->string(32),
                'home_team_id'      => $this->integer()->notNull(),
                'home_score'        => $this->integer()->notNull()->defaultValue(0),
                'away_team_id'      => $this->integer()->notNull(),
                'away_score'        => $this->integer()->notNull()->defaultValue(0),
                'halftime_score'    => $this->string(16),
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
        $this->dropTable('{{match}}');
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
