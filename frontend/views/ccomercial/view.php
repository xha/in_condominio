<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ccomercial */

$this->title = $model->CodVend;
$this->params['breadcrumbs'][] = ['label' => 'Centro Comercial', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccomercial-view">

    <p>
        <?= Html::a('<i class="fa fa-save"></i> Actualizar', ['update', 'id' => $model->CodVend], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-close"></i> Desactivar', ['delete', 'id' => $model->CodVend], [
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
            'CodVend',
            'Descrip',
            //'TipoID3',
            //'TipoID',
            'ID3',
            'DescOrder',
            'Clase',
            'Direc1',
            'Direc2',
            'Telef',
            'Movil',
            'Email:email',
            /*'FechaUV',
            'FechaUC',
            'EsComiPV',
            'EsComiTV',
            'EsComiTC',
            'EsComiTU',
            'EsComiDT',
            'EsComiUT',
            'EsComiTM',*/
            'Activo',
        ],
    ]) ?>

</div>
