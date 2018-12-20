<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UbicacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ubicaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-index">

    <center>
        <?= Html::a('<i class="fa fa-file"></i> Crear Ubicación', ['create'], ['class' => 'btn btn-success']) ?>
    </center>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_ubicacion',
            'nombre',
            'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
