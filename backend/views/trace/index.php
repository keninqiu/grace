<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TraceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Traces');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trace-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Trace'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'src_product_id',
            'dest_product_id',
            [
                'label' => Yii::t('app', 'Process Name'),
                'attribute' => 'process_name',
                'value' => 'process.name',  
            ], 
            [
                'label' => Yii::t('app', 'Employee Name'),
                'attribute' => 'employee_name',
                'value' => 'employee.name',  
            ],
            [
                'label' => Yii::t('app', 'Hours'),
                'attribute' => 'hours',
                'value' => 'hours',  
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
