<?php

use yii\db\Migration;

class m130524_201794_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('trace', [
            'id' => $this->primaryKey(),
            'src_product_id' => $this->string()->notNull(),
            'dest_product_id' => $this->string()->notNull(),
            'process_id' => $this->string()->notNull(),
            'employee_id' => $this->string()->notNull(),
            'created_at' => $this->dateTime()

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('trace');
    }
}