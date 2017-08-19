<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create', array('process_id' =>1)], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => Yii::t('app', 'Type Name'),
                'attribute' => 'type_name',
                'value' => 'type.name',  
            ],  
            [
                'label' => Yii::t('app', 'Box Name'),
                'attribute' => 'box_name',
                'value' => 'box.name',  
            ],  

            'quantity',
            [
                'label' => Yii::t('app', 'Spec Name'),
                'attribute' => 'spec_name',
                'value' => 'spec.name',  
            ],             
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
