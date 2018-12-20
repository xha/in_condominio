<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ccomercial */

$this->title = 'Actualizar Centro Comercial: ' . $model->CodVend;
$this->params['breadcrumbs'][] = ['label' => 'Centro Comercial', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodVend, 'url' => ['view', 'id' => $model->CodVend]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="ccomercial-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
