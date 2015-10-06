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
                'id'            => $this->primaryKey(),
                'api_id'        => $this->integer()->notNull(),
                'name'          => $this->string(128)->notNull(),
                'region'        => $this->string(128)->notNull(),
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
