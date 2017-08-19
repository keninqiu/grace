<?php

use yii\db\Migration;

class m130524_201792_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('process_relation', [
            'id' => $this->primaryKey(),
            'process_id' => $this->integer()->notNull(),
            'parent_process_id' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('process');
    }
}
