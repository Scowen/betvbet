<?php

use yii\db\Schema;
use yii\db\Migration;

class m151005_210629_create_table_competition extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{competition}}',
            array(
                'id'            => 'pk                    ',
                'api_id'        => 'INT           NOT NULL',
                'name'          => 'VARCHAR(128)  NOT NULL',
                'region'        => 'VARCHAR(128)  NOT NULL',
                'last_updated'  => 'INT           NOT NULL',
                'created'       => 'INT           NOT NULL',
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
        $this->dropTable('{{competition}}');
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
