<?php
namespace frontend\models;

use yii\base\Model;
use yii\db\Expression;
use common\models\BuyingRequest;

class RequestForm extends Model
{
    public $name;
    public $phone;
    public $brand_id;
    public $car_model_id;

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Укажите имя'],
            ['phone', 'required', 'message' => 'Укажите телефон для связи'],
            [['brand_id', 'car_model_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'phone' => 'Телефон',
        ];
    }

    public function request()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $buying_request = new BuyingRequest();
        $buying_request->name = $this->name;
        $buying_request->phone = $this->phone;
        $buying_request->brand_id = $this->brand_id;
        $buying_request->car_model_id = $this->car_model_id;
        $buying_request->created_at = time();
        $buying_request->updated_at = time();
        
        return $buying_request->save() ? $buying_request : null;
    }
}
