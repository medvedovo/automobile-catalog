<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "car_picture".
 *
 * @property integer $id
 * @property string $car_picture_url
 * @property integer $car_model_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CarModel $carModel
 */
class CarPicture extends \yii\db\ActiveRecord
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
        return 'car_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_picture_url', 'car_model_id', 'created_at', 'updated_at'], 'required'],
            [['car_model_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['car_picture_url'], 'string', 'max' => 255],
            [['car_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => CarModel::className(), 'targetAttribute' => ['car_model_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_picture_url' => 'Car Picture Url',
            'car_model_id' => 'Car Model ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarModel()
    {
        return $this->hasOne(CarModel::className(), ['id' => 'car_model_id']);
    }
}
