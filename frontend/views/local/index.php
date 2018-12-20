<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LocalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-index">

    <center>
        <?= Html::a('<i class="fa fa-file"></i> Crear Local', ['create'], ['class' => 'btn btn-success']) ?>
    </center>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_local',
            [
              'attribute'=>'CodClie',
              'value'=>'codClies.Descrip',
            ],
            [
              'attribute'=>'id_ubicacion',
              'value'=>'idUbicacion.nombre',
            ],
            [
              'attribute'=>'id_piso',
              'value'=>'idPiso.nombre',
            ],
            'metro',
            'porcentaje_alicuota',
            'monto_alquiler',
            // 'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
