<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use common\models\Brand;

class BrandEdit extends \common\models\Brand
{
    function __construct($brand)
    {
        foreach (get_object_vars($brand) as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public $brandLogo;

    public function rules()
    {
        return [
            [['brandLogo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->brandLogo->saveAs('/common/uploads/pictures/' . 'brand-' . $this->id . '_' . time() . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
