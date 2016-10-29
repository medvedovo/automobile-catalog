<?php

use yii\base\Model;
use yii\db\Expression;
use yii\db\Migration;
use common\models\User;

class m161028_191543_fill_with_data extends Migration
{
    public function up()
    {
        // Create admin user
        $user = new User();
        $user->username = 'admin';
        $user->email = '';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();

        /* Fill with some data */

        // Brands
        $this->insert('{{%brand}}', array(
            'id' => 1,
            'name' => 'Volvo',
            'slug' => 'volvo',
            'logo_url' => '/common/uploads/pictures/brand-1_1477718059.png',
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%brand}}', array(
            'id' => 2,
            'name' => 'SAAB',
            'slug' => 'saab',
            'logo_url' => '/common/uploads/pictures/brand-2_1477718385.png',
            'created_at' => time(),
            'updated_at' => time(),
        ));

        // Body types
        $this->insert('{{%body_type}}', array(
            'id' => 1,
            'name' => 'Sedan',
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%body_type}}', array(
            'id' => 2,
            'name' => 'Station Wagon',
            'created_at' => time(),
            'updated_at' => time(),
        ));

        // Car models
        $this->insert('{{%car_model}}', array(
            'id' => 1,
            'name' => 'S40 II',
            'slug' => 's40ii',
            'body_type_id' => 1,
            'description' => 'Volvo S40, V50 — автомобили производимые компанией Volvo Cars. Всего существует два поколения, первое в 1995 году, второе в 2004 году, а также был произведен рестайлинг в 2008 году',
            'brand_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%car_model}}', array(
            'id' => 2,
            'name' => 'V50',
            'slug' => 'v50',
            'body_type_id' => 2,
            'description' => 'Volvo S40, V50 — автомобили производимые компанией Volvo Cars. Всего существует два поколения, первое в 1995 году, второе в 2004 году, а также был произведен рестайлинг в 2008 году',
            'brand_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%car_model}}', array(
            'id' => 3,
            'name' => '9-3',
            'slug' => '9-3',
            'body_type_id' => 1,
            'description' => 'Saab 9-3 — среднеразмерный автомобиль Saab, производившийся с 1998 по 2014 год. Отличительная особенность автомобилей Saab — использование турбированных двигателей в большинстве серийных авто и позиционирование в премиум-сегменте по сравнению с «донором» платформы.',
            'brand_id' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ));

        // Car pictures
        $this->insert('{{%car_picture}}', array(
            'id' => 1,
            'car_picture_url' => '/common/uploads/pictures/car_model-1_1.jpg',
            'car_model_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%car_picture}}', array(
            'id' => 2,
            'car_picture_url' => '/common/uploads/pictures/car_model-1_2.jpg',
            'car_model_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%car_picture}}', array(
            'id' => 3,
            'car_picture_url' => '/common/uploads/pictures/car_model-2_1.jpg',
            'car_model_id' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ));
        $this->insert('{{%car_picture}}', array(
            'id' => 4,
            'car_picture_url' => '/common/uploads/pictures/car_model-3_1.jpg',
            'car_model_id' => 3,
            'created_at' => time(),
            'updated_at' => time(),
        ));

        // Buying requests
        $this->insert('{{%buying_request}}', array(
            'id' => 1,
            'name' => 'John Doe',
            'phone' => '+79279998877',
            'brand_id' => 1,
            'car_model_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ));
    }

    public function down()
    {
        echo "m161028_191543_fill_with_data cannot be reverted.\n";

        return false;
    }
}
