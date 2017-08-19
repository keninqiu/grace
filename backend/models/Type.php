<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 50],
            [['name'], 'unique'],
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
        ];
    }
}
