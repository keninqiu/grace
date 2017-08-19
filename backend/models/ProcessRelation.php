<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "process_relation".
 *
 * @property integer $id
 * @property integer $process_id
 * @property integer $parent_process_id
 */
class ProcessRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'process_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process_id'], 'required'],
            [['process_id', 'parent_process_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'process_id' => Yii::t('app', 'Process ID'),
            'parent_process_id' => Yii::t('app', 'Parent Process ID'),
        ];
    }

    public function getProcess()
    {
        return $this->hasOne(Process::className(), ['id' => 'process_id']);
    } 

    public function getParentProcess()
    {
        return $this->hasOne(Process::className(), ['id' => 'parent_process_id']);
    }     
}
