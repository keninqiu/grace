<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
    <?php $form = ActiveForm::begin(); ?>
    <p>
        <?= Html::textInput('quantity', $quantity); ?>
        <?= Yii::t('app', $spec_name); ?>
        <?= Html::hiddenInput('src_product_id', $src_product_id); ?>
        <?php 

            foreach($nextProcesses as $item) {

                echo Html::submitButton(Yii::t('app', $item["name"]), ['name' => 'process_id', 'value' => $item["id"], 'class' =>  'btn btn-success']) ;

            }
        ?>    
    </p>
    <?php ActiveForm::end(); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type.name',
            'box.name',
            'spec.name',
            'quantity'
        ],
    ]) ?>

</div>
