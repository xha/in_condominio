<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Correl */

$this->title = 'Actualizar Correlativo: ' . $model->id_correl;
$this->params['breadcrumbs'][] = ['label' => 'Correlativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_correl, 'url' => ['view', 'id' => $model->id_correl]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="correl-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
