<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = $model->id_alicuota;
$this->params['breadcrumbs'][] = ['label' => 'Locales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_alicuota], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id_alicuota], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Borrado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_alicuota',
            'CodClie',
            'id_ubicacion',
            'id_piso',
            'descripcion',
            'porcentaje',
            'alquiler',
            'activo',
        ],
    ]) ?>

</div>
