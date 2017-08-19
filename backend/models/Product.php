<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 * @property integer $type_id
 * @property integer $box_id
 * @property integer $spec_id
 * @property integer $quantity
 * @property integer $in_process
 * @property double $net_price
 * @property double $price
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'type_id', 'box_id', 'spec_id'], 'required'],
            [['type_id', 'box_id','spec_id','quantity','in_process'], 'integer'],
            [['net_price', 'price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'number' => Yii::t('app', 'Number'),
            'type_id' => Yii::t('app', 'Type ID'),
            'box_id' => Yii::t('app', 'Box ID'),
            'net_price' => Yii::t('app', 'Net Price'),
            'price' => Yii::t('app', 'Price'),
            'spec_id' => Yii::t('app', 'Spec ID'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

    public function getSpec()
    {
        return $this->hasOne(Spec::className(), ['id' => 'spec_id']);
    } 

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    } 

    public function getBox()
    {
        return $this->hasOne(Box::className(), ['id' => 'box_id']);
    } 
   
}
