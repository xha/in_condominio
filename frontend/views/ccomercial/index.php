<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CcomercialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Centro Comercial';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccomercial-index">

    <p>
        <?= Html::a('Crear Centro Comercial', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->Activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'CodVend',
            'Descrip',
            //'TipoID3',
            //'TipoID',
            //'ID3',
            //'DescOrder',
            [
              'attribute'=>'DescOrder',
              'value'=>'codUbic.Descrip',
            ],
            // 'Clase',
            'Direc1',
            // 'Direc2',
            // 'Telef',
            // 'Movil',
            // 'Email:email',
            // 'FechaUV',
            // 'FechaUC',
            // 'EsComiPV',
            // 'EsComiTV',
            // 'EsComiTC',
            // 'EsComiTU',
            // 'EsComiDT',
            // 'EsComiUT',
            // 'EsComiTM',
            //'Activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
