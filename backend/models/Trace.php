<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trace".
 *
 * @property integer $id
 * @property string $src_product_id
 * @property string $dest_product_id
 * @property string $process_id
 * @property string $employee_id
 * @property double $hours
 * @property string $created_at
 */
class Trace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src_product_id', 'dest_product_id', 'process_id', 'employee_id'], 'required'],
            [['created_at'], 'safe'],
            [['src_product_id', 'dest_product_id', 'process_id', 'employee_id'], 'string', 'max' => 255],
            [['hours'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'src_product_id' => Yii::t('app', 'Src Product ID'),
            'dest_product_id' => Yii::t('app', 'Dest Product ID'),
            'process_id' => Yii::t('app', 'Process ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getProcess()
    {
        return $this->hasOne(Process::className(), ['id' => 'process_id']);
    } 

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }     

}
