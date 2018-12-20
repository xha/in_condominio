<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="piso-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <center>
        <?= Html::a('<i class="fa fa-file"></i> Crear Piso', ['create'], ['class' => 'btn btn-success']) ?>
    </center>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_piso',
            'nombre',
            'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
