<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = $model->id_local;
$this->params['breadcrumbs'][] = ['label' => 'Locales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-view">

    <p>
        <?= Html::a('<i class="fa fa-save"></i> Actualizar', ['update', 'id' => $model->id_local], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-close"></i> Desactivar', ['delete', 'id' => $model->id_local], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_local',
            'CodClie',
            'id_ubicacion',
            'id_piso',
            'descripcion',
            'metro',
            'porcentaje_alicuota',
            'porcentaje_alquiler',
            'monto_alquiler',
            'alquiler',
            'activo',
        ],
    ]) ?>

</div>
