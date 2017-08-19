<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "box".
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 */
class Box extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'box';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            [['number'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
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
