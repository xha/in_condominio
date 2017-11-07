<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CorrelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Correlativos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correl-index">

    <p>
        <?= Html::a('Crear Correl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_correl',
            'canon',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
