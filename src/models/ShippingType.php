<?php

namespace dvizh\order\models;

use yii;

class ShippingType extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%order_shipping_type}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order'], 'integer'],
            [['cost', 'free_cost_from'], 'double'],
            [['description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('order', 'Name'),
            'order' => Yii::t('order', 'Sort'),
            'cost' => Yii::t('order', 'Cost'),
            'description' => Yii::t('order', 'Description'),
            'free_cost_from' => Yii::t('order', 'Free cost from'),
        ];
    }
}
