<?php

use yii\db\Schema;
use yii\db\Migration;

class m151011_154443_add_columns_user extends Migration
{
    public function up()
    {
        $this->addColumn("{{user}}", "title", $this->string());
        $this->addColumn("{{user}}", "firstname", $this->string());
        $this->addColumn("{{user}}", "middlename", $this->string());
        $this->addColumn("{{user}}", "lastname", $this->string());
        $this->addColumn("{{user}}", "dob", $this->integer());
        $this->addColumn("{{user}}", "contact", $this->string());
        $this->addColumn("{{user}}", "security", $this->string());
        $this->addColumn("{{user}}", "mother_maiden_name", $this->string());
        $this->addColumn("{{user}}", "currency", $this->string()->defaultValue("GBP"));
    }

    public function down()
    {
        echo "m151011_154443_add_columns_user cannot be reverted.\n";

        return false;
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
