<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Trace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trace-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'src_product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dest_product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'process_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
