<?php

use yii\db\Migration;

class m161028_175449_buying_request_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%buying_request}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'car_model_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_brand', '{{%buying_request}}', array('brand_id', 'id'), true);
        $this->addForeignKey('fk_buying_request_brand', '{{%buying_request}}', 'brand_id', '{{%brand}}', 'id', 'CASCADE');

        $this->createIndex('idx_car_model', '{{%buying_request}}', array('car_model_id', 'id'), true);
        $this->addForeignKey('fk_buying_request_car_model', '{{%buying_request}}', 'car_model_id', '{{%car_model}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%buying_request}}');
    }
}
