<?php

namespace dvizh\order\models;

use yii;
use dvizh\order\models\Field;

class FieldValue extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%order_field_value}}';
    }

    public function rules()
    {
        return [
            [['order_id', 'field_id'], 'required'],
            [['order_id', 'field_id'], 'unique', 'targetAttribute' => ['order_id', 'field_id']],
            [['value'], 'string'],
            [['value'], 'safe'],
        ];
    }

    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id'])->one();
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'order_id' => Yii::t('order', 'Order'),
            'field_id' => Yii::t('order', 'Field'),
            'value' => Yii::t('order', 'Value'),
        ];
    }
}
