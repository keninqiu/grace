<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProcessRelation */

$this->title = Yii::t('app', 'Create Process Relation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Process Relations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process-relation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
