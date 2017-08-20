<?php
namespace dvizh\order\models;

use yii;

class Payment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%order_payment}}';
    }

    public function rules()
    {
        return [
            [['order_id', 'amount', 'description', 'date', 'payment_type_id', 'ip'], 'required'],
            [['order_id', 'user_id', 'payment_type_id'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 55],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => Yii::t('order', 'Order'),
            'amount' => Yii::t('order', 'Amount'),
            'description' => Yii::t('order', 'Description'),
            'user_id' => Yii::t('order', 'User'),
            'date' => Yii::t('order', 'Date'),
            'payment_type_id' => Yii::t('order', 'Payment type'),
            'ip' => Yii::t('order', 'IP'),
        ];
    }
    
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    
    public function getPayment()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_type_id']);
    }
}
