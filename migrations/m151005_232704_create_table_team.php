<?php

use yii\db\Schema;
use yii\db\Migration;

class m151005_232704_create_table_team extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{team}}',
            array(
                'id'            => $this->primaryKey(),
                'team_id'       => $this->integer()->notNull(),
                'competition'   => $this->integer()->notNull(),
                'name'          => $this->string(128)->notNull(),
                'logo'          => $this->text(),
                'status'        => $this->string(128),
                'form'          => $this->string(128),
                'position'      => $this->integer(),
                'overall_gp'    => $this->integer(),
                'overall_w'     => $this->integer(),
                'overall_d'     => $this->integer(),
                'overall_l'     => $this->integer(),
                'overall_gs'    => $this->integer(),
                'overall_ga'    => $this->integer(),
                'overall_gp'    => $this->integer(),
                'home_w'        => $this->integer(),
                'home_d'        => $this->integer(),
                'home_l'        => $this->integer(),
                'home_gs'       => $this->integer(),
                'home_ga'       => $this->integer(),
                'away_gp'       => $this->integer(),
                'away_w'        => $this->integer(),
                'away_d'        => $this->integer(),
                'away_l'        => $this->integer(),
                'away_gs'       => $this->integer(),
                'away_ga'       => $this->integer(),
                'gd'            => $this->integer(),
                'points'        => $this->integer(),
                'last_updated'  => $this->integer()->notNull(),
                'created'       => $this->integer()->notNull(),
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
        $this->dropTable('{{team}}');
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
