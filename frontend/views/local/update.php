<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = 'Actualizar Local: ' . $model->id_alicuota;
$this->params['breadcrumbs'][] = ['label' => 'Locales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_alicuota, 'url' => ['view', 'id' => $model->id_alicuota]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="local-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
