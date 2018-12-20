<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Local */

$this->title = 'Actualizar Local: ' . $model->id_local;
$this->params['breadcrumbs'][] = ['label' => 'Locales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_local, 'url' => ['view', 'id' => $model->id_local]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="local-update">

    <?= $this->render('_form', [
        'model' => $model,
        'canon' => $canon,
    ]) ?>

</div>
