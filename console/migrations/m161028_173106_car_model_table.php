<?php

use yii\db\Migration;

class m161028_173106_car_model_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%car_model}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'body_type_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'brand_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_brand', '{{%car_model}}', array('brand_id', 'id'), true);
        $this->addForeignKey('fk_car_model_brand', '{{%car_model}}', 'brand_id', '{{%brand}}', 'id', 'CASCADE');

        $this->createIndex('idx_body_type', '{{%car_model}}', array('body_type_id', 'id'), true);
        $this->addForeignKey('fk_car_model_body_type', '{{%car_model}}', 'body_type_id', '{{%body_type}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%car_model}}');
    }
}
