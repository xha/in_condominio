<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CorrelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Correlativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correl-index">

    <center>
        <?= Html::a('<i class="fa fa-file"></i> Crear Correlativo', ['create'], ['class' => 'btn btn-success']) ?>
    </center>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_correl',
            'CodVend',
            'canon',
            'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
