<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "car_model".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $body_type_id
 * @property string $description
 * @property integer $brand_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BuyingRequest[] $buyingRequests
 * @property BodyType $bodyType
 * @property Brand $brand
 * @property CarPicture[] $carPictures
 */
class CarModel extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'body_type_id', 'brand_id', 'created_at', 'updated_at'], 'required'],
            [['body_type_id', 'brand_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['body_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => BodyType::className(), 'targetAttribute' => ['body_type_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'body_type_id' => 'Body Type ID',
            'description' => 'Description',
            'brand_id' => 'Brand ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyingRequests()
    {
        return $this->hasMany(BuyingRequest::className(), ['car_model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBodyType()
    {
        return $this->hasOne(BodyType::className(), ['id' => 'body_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarPictures()
    {
        return $this->hasMany(CarPicture::className(), ['car_model_id' => 'id']);
    }
}
