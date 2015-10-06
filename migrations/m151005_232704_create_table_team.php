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
                'id'            => 'pk',
                'team_id'       => 'INT NOT NULL',
                'competition'   => 'INT NOT NULL',
                'name'          => 'VARCHAR(128) NOT NULL',
                'logo'          => 'TEXT NULL',
                'status'        => 'VARCHAR(128) NULL',
                'form'          => 'VARCHAR(128) NULL',
                'position'      => 'INT NULL',
                'overall_gp'    => 'INT NULL',
                'overall_w'     => 'INT NULL',
                'overall_d'     => 'INT NULL',
                'overall_l'     => 'INT NULL',
                'overall_gs'    => 'INT NULL',
                'overall_ga'    => 'INT NULL',
                'overall_gp'    => 'INT NULL',
                'home_w'        => 'INT NULL',
                'home_d'        => 'INT NULL',
                'home_l'        => 'INT NULL',
                'home_gs'       => 'INT NULL',
                'home_ga'       => 'INT NULL',
                'away_gp'       => 'INT NULL',
                'away_w'        => 'INT NULL',
                'away_d'        => 'INT NULL',
                'away_l'        => 'INT NULL',
                'away_gs'       => 'INT NULL',
                'away_ga'       => 'INT NULL',
                'gd'            => 'INT NULL',
                'points'        => 'INT NULL',
                'last_updated'  => 'INT NOT NULL',
                'created'       => 'INT NOT NULL',
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
