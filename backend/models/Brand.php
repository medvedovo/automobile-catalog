<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $logo_url
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BuyingRequest[] $buyingRequests
 * @property CarModel[] $carModels
 */
class Brand extends \yii\db\ActiveRecord
{
    public $file;

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
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['file'], 'file', 'extensions' => 'png, jpg', 'mimeTypes' => 'image/jpeg, image/png'],
            [['name', 'slug', 'logo_url'], 'string', 'max' => 255],
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
            'logo_url' => 'Logo Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyingRequests()
    {
        return $this->hasMany(BuyingRequest::className(), ['brand_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarModels()
    {
        return $this->hasMany(CarModel::className(), ['brand_id' => 'id']);
    }
}
