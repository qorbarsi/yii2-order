<?php
namespace dvizh\order\models;

use yii;

class FieldType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%order_field_type}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['widget'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'name' => Yii::t('order', 'Name'),
            'widget' => Yii::t('order', 'Widget'),
        ];
    }
}
