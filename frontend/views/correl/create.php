<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Correl */

$this->title = 'Crear Correlativo';
$this->params['breadcrumbs'][] = ['label' => 'Correlativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correl-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
