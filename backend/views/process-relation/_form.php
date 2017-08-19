<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Process;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ProcessRelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="process-relation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'process_id')->dropDownList(ArrayHelper::map(Process::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'parent_process_id')->dropDownList(ArrayHelper::map(Process::find()->all(), 'id', 'name'),['prompt'=>'Select...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
