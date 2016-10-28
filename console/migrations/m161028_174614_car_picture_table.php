<?php

use yii\db\Migration;

class m161028_174614_car_picture_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%car_picture}}', [
            'id' => $this->primaryKey(),
            'car_picture_url' => $this->string()->notNull(),
            'car_model_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('idx_car_model', '{{%car_picture}}', array('car_model_id', 'id'), true);
        $this->addForeignKey('fk_car_picture_car_model', '{{%car_picture}}', 'car_model_id', '{{%car_model}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%car_picture}}');
    }
}
