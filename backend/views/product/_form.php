<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Type;
use app\models\Box;
use app\models\Spec;
use app\models\Process;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Type::find()->all(), 'id', 'name')) ?>

    <?= Html::hiddenInput('src_product_id',$src_product_id); ?>
    

    <?= $form->field($model, 'box_id')->dropDownList(ArrayHelper::map(Box::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'spec_id')->dropDownList(ArrayHelper::map(Spec::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?php 
    if($process_id == Process::PURCHASE) {
    ?>
    <?= $form->field($model, 'net_price')->textInput() ?>
    <?php
    }
    ?>

    <div class="form-group">
        <label class="control-label"><?= Yii::t('app', 'Employee') ?></label>
        <?= Html::dropDownList('employee', $employeeIds,$employeeNames, ['class' => 'form-control']); ?>
    </div>
    <div class="form-group">
        <label class="control-label"><?= Yii::t('app', 'Hours') ?></label>
        <?= Html::textInput('hours',0, ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next Product') : Yii::t('app', 'Update'), ['name' => 'next_product', 'value' => 'next_product', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Finish') : Yii::t('app', 'Update'), ['name' => 'finish', 'value' => 'finish', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
